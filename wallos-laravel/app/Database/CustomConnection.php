<?php

namespace App\Database;

use Illuminate\Database\Connection as BaseConnection;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use PDOException;

class CustomConnection extends BaseConnection
{
    /**
     * Create a new database connection instance.
     *
     * @param  \Illuminate\Database\Connectors\ConnectionFactory  $factory
     * @param  array  $config
     * @return void
     */
    public function __construct($factory, $config)
    {
        $this->verifyPdoDriver($config['driver']);
        parent::__construct($factory, $config);
    }

    /**
     * Verify PDO driver is available
     */
    protected function verifyPdoDriver(string $driver): void
    {
        if (!in_array($driver, \PDO::getAvailableDrivers())) {
            $message = "Database driver not found (Requested: {$driver})\n\n";
            $message .= "Available drivers: " . implode(', ', \PDO::getAvailableDrivers()) . "\n\n";
            $message .= $this->getDriverInstallationInstructions($driver);
            
            throw new \RuntimeException($message);
        }
    }

    /**
     * Get installation instructions for missing drivers
     */
    protected function getDriverInstallationInstructions(string $driver): string
    {
        $instructions = [
            'sqlite' => "To install SQLite driver:\n"
                      . "1. Uncomment 'extension=pdo_sqlite' in php.ini\n"
                      . "2. Ensure SQLite is installed on your system\n"
                      . "3. Restart your web server",
                      
            'mysql' => "To install MySQL driver:\n"
                     . "1. Uncomment 'extension=pdo_mysql' in php.ini\n"
                     . "2. Install MySQL client libraries\n"
                     . "3. Restart your web server",
                     
            'pgsql' => "To install PostgreSQL driver:\n"
                      . "1. Uncomment 'extension=pdo_pgsql' in php.ini\n"
                      . "2. Install PostgreSQL client libraries\n"
                      . "3. Restart your web server"
        ];

        return $instructions[strtolower($driver)] ?? "Check PHP documentation for {$driver} PDO driver installation";
    }

    /**
     * Run a SQL statement and handle exceptions with enhanced error information
     */
    protected function runQueryCallback($query, $bindings, \Closure $callback)
    {
        try {
            return parent::runQueryCallback($query, $bindings, $callback);
        } catch (QueryException $e) {
            $this->enhanceQueryException($e, $query, $bindings);
            throw $e;
        } catch (PDOException $e) {
            $this->enhancePdoException($e, $query, $bindings);
            throw $e;
        }
    }

    protected function enhanceQueryException(QueryException $e, string $query, array $bindings): void
    {
        $message = $e->getMessage();
        $message .= "\n\nSQL Query: " . $this->getFullSql($query, $bindings);
        
        if (preg_match('/table [\'"`]?([^\s\'"`]+)/i', $message, $matches)) {
            $message .= "\nTable: " . $matches[1];
        }
        
        $message .= "\nTransaction: " . ($this->transactionLevel() > 0 ? 'Yes' : 'No');
        $message .= "\nDriver: " . $this->getConfig('driver') . ' ' . ($this->getPdo() ? $this->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION) : 'Not connected');

        $e = new QueryException(
            $query,
            $bindings,
            $message,
            $e->getCode(),
            $e->getPrevious()
        );
    }

    protected function enhancePdoException(PDOException $e, string $query, array $bindings): void
    {
        if ($e->getCode() === '23000') {
            $this->enhanceUniqueConstraintViolation($e, $query, $bindings);
        }
    }

    protected function enhanceUniqueConstraintViolation(PDOException $e, string $query, array $bindings): void
    {
        $message = "Unique constraint violation occurred";
        
        if (preg_match('/CONSTRAINT [`"]([^`"]+)[`"]/i', $e->getMessage(), $matches)) {
            $message .= "\nConstraint: " . $matches[1];
        }
        
        $message .= "\nPossible resolutions:";
        $message .= "\n- Check for duplicate values";
        $message .= "\n- Verify upsert columns";
        $message .= "\n- Use firstOrCreate/firstOrNew";

        throw new UniqueConstraintViolationException(
            $query,
            $bindings,
            $message,
            $e->getCode(),
            $e
        );
    }

    protected function getFullSql(string $query, array $bindings): string
    {
        return vsprintf(str_replace('?', "'%s'", $query), $bindings);
    }
}
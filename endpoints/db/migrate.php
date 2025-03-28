<?php
function errorHandler($severity, $message, $file, $line)
{
    throw new ErrorException($message, 0, $severity, $file, $line);
}

// Set the custom error handler
set_error_handler('errorHandler');

try {
    // Try primary connection path
    if (file_exists('includes/connect_endpoint_crontabs.php')) {
        require_once 'includes/connect_endpoint_crontabs.php';
    }
    // Fallback to secondary path
    elseif (file_exists('../../includes/connect_endpoint.php')) {
        require_once '../../includes/connect_endpoint.php';
    } else {
        throw new Exception('Could not locate database connection file');
    }

    // Verify database is writable
    if (!is_writable($db->filename)) {
        throw new Exception('Database file is not writable: ' . $db->filename);
    }


$completedMigrations = [];

$migrationTableExists = $db
    ->query('SELECT name FROM sqlite_master WHERE type="table" AND name="migrations"')
    ->fetchArray(SQLITE3_ASSOC) !== false;

if ($migrationTableExists) {
    $migrationQuery = $db->query('SELECT migration FROM migrations');
    while ($row = $migrationQuery->fetchArray(SQLITE3_ASSOC)) {
        $completedMigrations[] = $row['migration'];
    }
}

$allMigrations = glob('migrations/*.php');
if (count($allMigrations) == 0) {
    $allMigrations = glob('../../migrations/*.php');
}

$allMigrations = array_map(function ($migration) {
    return str_replace('../../', '', $migration);
}, $allMigrations);

$completedMigrations = array_map(function ($migration) {
    return str_replace('../../', '', $migration);
}, $completedMigrations);

$requiredMigrations = array_diff($allMigrations, $completedMigrations);

if (count($requiredMigrations) === 0) {
    echo "No migrations to run.\n";
}

foreach ($requiredMigrations as $migration) {
    if (!file_exists($migration)) {
        $migration = '../../' . $migration;
    }
    require_once $migration;

    $stmtInsert = $db->prepare('INSERT INTO migrations (migration) VALUES (:migration)');
    $stmtInsert->bindParam(':migration', $migration, SQLITE3_TEXT);
    $stmtInsert->execute();

    echo sprintf("Migration %s completed successfully.\n", $migration);
}

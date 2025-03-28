<?php
echo "Checking SQLite extensions:\n";
echo "SQLite3: " . (extension_loaded('sqlite3') ? 'Enabled' : 'Disabled') . "\n";
echo "PDO_SQLite: " . (extension_loaded('pdo_sqlite') ? 'Enabled' : 'Disabled') . "\n";
?>
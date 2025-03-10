<?php
// Define .env file path
$envPath = __DIR__ . '/../../.env';

// Check if the file exists before parsing
if (!file_exists($envPath)) {
    die("Error: Configuration file not found.");
}

$config = parse_ini_file($envPath);

if (!$config) {
    die("Error: Failed to parse configuration file.");
}

try {
    $con_sccdrrmo = new PDO(
        "mysql:host={$config['DB_SCCDRRMO_HOST']};dbname={$config['DB_SCCDRRMO_NAME']};charset=utf8mb4",
        $config['DB_SCCDRRMO_USER'],
        $config['DB_SCCDRRMO_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    $con_scims = new PDO(
        "mysql:host={$config['DB_SCIMS_HOST']};dbname={$config['DB_SCIMS_NAME']};charset=utf8mb4",
        $config['DB_SCIMS_USER'],
        $config['DB_SCIMS_PASS'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage()); // Log the error
    die("Database connection error. Please try again later.");
}
?>

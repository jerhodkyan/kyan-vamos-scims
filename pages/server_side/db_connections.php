<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define .env file path
$envPath = __DIR__ . '/../../.env';

// Check if the .env file exists
if (!file_exists($envPath)) {
    echo json_encode(["status" => "error", "message" => "Error: Configuration file not found."]);
    exit;
}

// Parse .env file
$config = parse_ini_file($envPath);
if (!$config) {
    echo json_encode(["status" => "error", "message" => "Error: Failed to parse configuration file."]);
    exit;
}

// Required config keys
$requiredKeys = [
    'DB_SCCDRRMO_HOST',
    'DB_SCCDRRMO_NAME',
    'DB_SCCDRRMO_USER',
    'DB_SCCDRRMO_PASS',
    'DB_SCIMS_HOST',
    'DB_SCIMS_NAME',
    'DB_SCIMS_USER',
    'DB_SCIMS_PASS'
];

foreach ($requiredKeys as $key) {
    if (!isset($config[$key])) {
        echo json_encode(["status" => "error", "message" => "Error: Missing configuration key: $key"]);
        exit;
    }
}

try {
    // Connect to SCCDRRMO Database
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

    // Connect to SCIMS Database
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

    // echo json_encode(["status" => "success", "message" => "Database connection successful."]);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database connection error. Please try again later."]);
    exit;
}

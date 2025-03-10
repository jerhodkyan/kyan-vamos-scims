<?php

/// Load environment variables from .env file
$envPath = __DIR__ . '/../../.env';

try {
   $con_scims = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
   ]);
} catch (PDOException $e) {
   die("Database connection failed: " . $e->getMessage());
}

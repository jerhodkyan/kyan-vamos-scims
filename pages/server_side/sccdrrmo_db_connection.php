// <?php
// $host = "localhost";
// $dbname = "sccdrrmo";
// $username = "root";
// $password = "";

$host = "34.92.117.58";
$dbname = "sccdrrmo";
$username = "root";
$password = "I0nvNUWNXoYI";

try {
   $con_sccdrrmo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
   ]);
} catch (PDOException $e) {
   die("Database connection failed: " . $e->getMessage());
}

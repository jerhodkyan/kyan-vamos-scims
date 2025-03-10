<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '../server_side/php_errors.log');

include('../db_connections.php');

date_default_timezone_set('Asia/Manila');
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set unique department ID
    $uniqueId = uniqid('addrs', true);
    $uniqueId = str_replace('.', 'i', $uniqueId);
    $address_id = substr($uniqueId, 0, 8) . '-' . substr($uniqueId, 8, 4) . '-' . substr($uniqueId, 12, 8) . '-' . substr($uniqueId, 20, 4);

    //Save Individual Information
    try {

        $entity_no = $_POST['entityNum'] ?? '';
        $address_type = $_POST['address_type'] ?? ''; 
        $residency = $_POST['residency'] ?? '';
        $upblb_num = $_POST['upblb_num'] ?? '';
        $subdivision = $_POST['subdivision'] ?? '';
        $street = $_POST['street'] ?? '';
        $barangay = $_POST['barangay'] ?? '';
        $city = $_POST['city'] ?? '';
        $province = $_POST['province'] ?? '';
        $region = $_POST['region'] ?? '';
        $zip = $_POST['zip'] ?? '';
        $longtitude = $_POST['longtitude'] ?? '';
        $latitude = $_POST['latitude'] ?? '';

        $insert_individual_sql = "INSERT INTO address_info (
            address_type, residency, upblb_num, subdivision, street, barangay, city, 
            province, region, zip, longtitude, latitude
        ) VALUES (
            :address_type, :residency, :upblb_num, :subdivision, :street, :barangay, :city, 
            :province, :region, :zip, :longtitude, :latitude
        )";

        $individual_data = $con_scims->prepare($insert_individual_sql);
        $individual_data->execute([
            ':individual_id' => $address_id,
            ':entity_no' => $entity_no,
            ':address_type' => $address_type,
            ':residency' => $residency,
            ':upblb_num' => $upblb_num,
            ':subdivision' => $subdivision,
            ':street' => $street,
            ':barangay' => $barangay,
            ':city' => $city,
            ':province' => $province,
            ':region' => $region,
            ':zip' => $zip,
            ':longtitude' => $longtitude,
            ':latitude' => $latitude,
        ]);

        $response['status'] = "success";
        $response['message'] = "Record successfully inserted!";
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        $response['status'] = "error";
        $response['message'] = "Data Already registered.";
    }

    $individual_data = null;
    $con_scims = null;
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request method";
}

// Ensure JSON response only
header('Content-Type: application/json');
echo json_encode($response);
exit;

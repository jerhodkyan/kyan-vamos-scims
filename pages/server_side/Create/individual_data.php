<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '../server_side/php_errors.log');

include('../db_connections.php');

date_default_timezone_set('Asia/Manila');
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Generate Unique Individual ID
    $uniqueId = uniqid('indi', true);
    $uniqueId = str_replace('.', 'i', $uniqueId);
    $individual_id = substr($uniqueId, 0, 8) . '-' . substr($uniqueId, 8, 4) . '-' . substr($uniqueId, 12, 8) . '-' . substr($uniqueId, 20, 4);

    // Get Individual Data from POST
    $entity_no = $_POST['entityNum'] ?? '';
    $first_name = $_POST['firstname'] ?? '';
    $middle_name = $_POST['middlename'] ?? '';
    $last_name = $_POST['lastname'] ?? '';
    $suffix = $_POST['suffix'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birth_date = !empty($_POST['dobInput']) ? date('Y-m-d', strtotime($_POST['dobInput'])) : null;
    $place_birth = $_POST['place_birth'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $civil_status = $_POST['civilstatus'] ?? '';
    $citizenship = $_POST['citizenship'] ?? '';
    $mobile_no = $_POST['contact'] ?? '';
    $photo = $_POST['photo'] ?? '';
    $status = $_POST['status'] ?? '';
    $blood_type = $_POST['blood_type'] ?? '';

    // Generate Unique Address ID
    $uniqueAddrId = uniqid('addrs', true);
    $uniqueAddrId = str_replace('.', 'i', $uniqueAddrId);
    $address_id = substr($uniqueAddrId, 0, 8) . '-' . substr($uniqueAddrId, 8, 4) . '-' . substr($uniqueAddrId, 12, 8) . '-' . substr($uniqueAddrId, 20, 4);

    // Get Address Data from POST
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
    $longitude = $_POST['longitude'] ?? '';
    $latitude = $_POST['latitude'] ?? '';

    // List of required fields (ensure all fields are defined before checking)
    $required_fields = [
        'entityNum' => $entity_no,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'gender' => $gender,
        'birth_date' => $birth_date,
        'address_type' => $address_type,
        'residency' => $residency,
        'barangay' => $barangay,
        'city' => $city,
        'province' => $province,
        'region' => $region,
        'zip' => $zip,
    ];

    // Check for empty required fields
    $missing_fields = [];
    foreach ($required_fields as $field_name => $value) {
        if (empty($value)) {
            $missing_fields[] = $field_name;
        }
    }

    if (!empty($missing_fields)) {
        $response['status'] = "error";
        $response['message'] = "Missing required fields: " . implode(", ", $missing_fields);
    } else {
        try {
            // Start Transaction
            $con_scims->beginTransaction();

            // Insert Individual Information
            $insert_individual_sql = "INSERT INTO individual_info (
                individual_id, entity_no, first_name, middle_name, last_name, suffix, gender, 
                birth_date, place_birth, religion, civil_status, citizenship, mobile_no, photo, status, blood_type
            ) VALUES (
                :individual_id, :entity_no, :first_name, :middle_name, :last_name, :suffix, :gender, 
                :birth_date, :place_birth, :religion, :civil_status, :citizenship, :mobile_no, :photo, :status, :blood_type
            )";

            $stmt = $con_scims->prepare($insert_individual_sql);
            $stmt->execute([
                ':individual_id' => $individual_id,
                ':entity_no' => $entity_no,
                ':first_name' => $first_name,
                ':middle_name' => $middle_name,
                ':last_name' => $last_name,
                ':suffix' => $suffix,
                ':gender' => $gender,
                ':birth_date' => $birth_date,
                ':place_birth' => $place_birth,
                ':religion' => $religion,
                ':civil_status' => $civil_status,
                ':citizenship' => $citizenship,
                ':mobile_no' => $mobile_no,
                ':photo' => $photo,
                ':status' => $status,
                ':blood_type' => $blood_type,
            ]);

            // Insert Address Information
            $insert_address_sql = "INSERT INTO address_info (
                address_id, entity_no, address_type, residency, upblb_num, subdivision, street, barangay, city, 
                province, region, zip, longitude, latitude
            ) VALUES (
                :address_id, :entity_no, :address_type, :residency, :upblb_num, :subdivision, :street, :barangay, :city, 
                :province, :region, :zip, :longitude, :latitude
            )";

            $stmt = $con_scims->prepare($insert_address_sql);
            $stmt->execute([
                ':address_id' => $address_id,
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
                ':longitude' => $longitude,
                ':latitude' => $latitude,
            ]);

            // Commit Transaction
            $con_scims->commit();

            $response['status'] = "success";
            $response['message'] = "Record successfully inserted!";
        } catch (PDOException $e) {
            // Rollback Transaction on Error
            $con_scims->rollBack();

            error_log("Database Error: " . $e->getMessage());
            // Return the actual error message in the JSON response
            $response['status'] = "error";
            $response['message'] = "Database Error: " . $e->getMessage();
        }
    }
    // Close Connection
    $stmt = null;
    $con_scims = null;
} else {
    $response['status'] = "error";
    $response['message'] = "Invalid request method";
}

// Return JSON Response
header('Content-Type: application/json');
echo json_encode($response);
exit;

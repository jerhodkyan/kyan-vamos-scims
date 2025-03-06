<?php
error_reporting(E_ALL);
ini_set('display_errors', 0); // Prevents output of warnings/errors in AJAX response
ini_set('log_errors', 1);
ini_set('error_log', '../server_side/php_errors.log'); // Logs errors to a file

include('../server_side/local_scims_db_connection.php');

date_default_timezone_set('Asia/Manila');
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set unique department ID
    $uniqueId = uniqid('indi', true);
    $uniqueId = str_replace('.', 'i', $uniqueId);
    $individual_idValue = substr($uniqueId, 0, 8) . '-' . substr($uniqueId, 8, 4) . '-' . substr($uniqueId, 12, 8) . '-' . substr($uniqueId, 20, 4);

    //Save Individual Information
    try {
        $individual_id = $individual_idValue;
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

        $insert_individual_sql = "INSERT INTO individual_info (
            individual_id, entity_no, first_name, middle_name, last_name, suffix, gender, 
            birth_date, place_birth, religion, civil_status, citizenship, mobile_no, photo, status, blood_type
        ) VALUES (
            :individual_id, :entity_no, :first_name, :middle_name, :last_name, :suffix, :gender, 
            :birth_date, :place_birth, :religion, :civil_status, :citizenship, :mobile_no, :photo, :status, :blood_type
        )";

        $individual_data = $con_scims->prepare($insert_individual_sql);
        $individual_data->execute([
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

        $response['status'] = "success";
        $response['message'] = "Record successfully inserted!";
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Logs error to php_errors.log
        $response['status'] = "error";
        $response['message'] = "Data Already registered.";
    }

    //Save Individual Education
    try {
        $educ_id = uniqid('edu', true);
        $educ_id = str_replace('.', 'e', $educ_id);
        $educ_idValue = substr($educ_id, 0, 8) . '-' . substr($educ_id, 8, 4) . '-' . substr($educ_id, 12, 8) . '-' . substr($educ_id, 20, 4);

        $individual_id = $individual_idValue;
        $school_level = $_POST['level'] ?? '';
        $school_name = $_POST['schoolName'] ?? '';
        $year_graduated = !empty($_POST['yearGraduated']) ? date('Y-m-d', strtotime($_POST['yearGraduated'])) : null;
        $units_earned = $_POST['unitsEarned'] ?? '';
        $honors = $_POST['honors'] ?? '';
        $remarks = $_POST['remarks'] ?? '';

        $insert_education_sql = "INSERT INTO educational_background (
            educ_id, individual_id, school_level, school_name, year_graduated, units_earned, honors, remarks
        ) VALUES (
            :educ_id, :individual_id, :school_level, :school_name, :year_graduated, :units_earned, :honors, :remarks
        )";

        $education_data = $con_scims->prepare($insert_education_sql);
        $education_data->execute([
            ':educ_id' => $educ_idValue,
            ':individual_id' => $individual_id,
            ':school_level' => $school_level,
            ':school_name' => $school_name,
            ':year_graduated' => $year_graduated,
            ':units_earned' => $units_earned,
            ':honors' => $honors,
            ':remarks' => $remarks,
        ]);

        $response['status'] = "success";
        $response['message'] = "Educational Record successfully inserted!";
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Logs error to php_errors.log
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

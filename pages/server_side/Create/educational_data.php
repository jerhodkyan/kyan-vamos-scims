<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Prevent warnings/errors from breaking AJAX response
ini_set('log_errors', 1);
ini_set('error_log', '../server_side/php_errors.log'); // Log errors to a file

include('../db_connections.php');

date_default_timezone_set('Asia/Manila');
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Read raw JSON input
    $jsonInput = file_get_contents("php://input");
    $data = json_decode($jsonInput, true);

    // Log what PHP receives
    error_log("🔹 Raw JSON Input: " . $jsonInput);
    error_log("🔹 Decoded JSON: " . print_r($data, true));

    // Ensure PHP correctly receives educationData
    if (!empty($data['educationData'])) {
        $_POST = $data;  // ✅ Convert JSON to $_POST
    } else {
        $response['status'] = "error";
        $response['message'] = "No education data received (JSON).";
        echo json_encode($response);
        exit;
    }

    // Get POST Data
    $educationData = $_POST['educationData'] ?? [];
    $entity_no = $_POST['entityNum'] ?? '';

    // Debugging logs
    error_log("Received educationData: " . print_r($educationData, true));
    error_log("Entity Number: " . $entity_no);

    // Check if educationData exists and is an array
    if (!isset($educationData) || !is_array($educationData) || empty($educationData)) {
        $response['status'] = "error";
        $response['message'] = "No education data received.";
        echo json_encode($response);
        exit;
    }

    $errors = [];
    
    foreach ($educationData as $index => $entry) {
        $entryErrors = [];

        if (empty($entry['level'])) {
            $entryErrors[] = "Level is missing (Row " . ($index + 1) . ")";
        }
        if (empty($entry['schoolName'])) {
            $entryErrors[] = "School Name is missing (Row " . ($index + 1) . ")";
        }
        if (empty($entry['period'])) {
            $entryErrors[] = "Date Period is missing (Row " . ($index + 1) . ")";
        }
        if (empty($entry['unitsEarned'])) {
            $entryErrors[] = "Units Earned is missing (Row " . ($index + 1) . ")";
        }
        if (empty($entry['yearGraduated'])) {
            $entryErrors[] = "Year Graduated is missing (Row " . ($index + 1) . ")";
        }

        if (!empty($entryErrors)) {
            $errors = array_merge($errors, $entryErrors);
        }
    }

    // If there are errors, return them
    if (!empty($errors)) {
        $response['status'] = "error";
        $response['message'] = implode("\n", $errors); // Combine errors into a single response
        echo json_encode($response);
        exit;
    }

    // SQL Insert Query
    $insert_education_sql = "INSERT INTO educational_background (
        educ_id, entity_no, school_level, school_name, date_from, date_to, school_units_earned, year_graduated, honors_received, remarks
    ) VALUES (
        :educ_id, :entity_no, :school_level, :school_name, :date_from, :date_to, :school_units_earned, :year_graduated, :honors_received, :remarks
    )";

    try {
        $stmt = $con_scims->prepare($insert_education_sql);

        foreach ($educationData as $entry) {

            // Generate Unique educ_id
            $educ_id = uniqid('edu', true);
            $educ_id = str_replace('.', 'e', $educ_id);
            $educ_idValue = substr($educ_id, 0, 8) . '-' . substr($educ_id, 8, 4) . '-' . substr($educ_id, 12, 8) . '-' . substr($educ_id, 20, 4);

            // Validate 'period' field
            if (isset($entry['period']) && strpos($entry['period'], " - ") !== false) {
                $dates = explode(" - ", $entry['period']);
                $date_from = $dates[0];
                $date_to = $dates[1];
            } else {
                $date_from = null;
                $date_to = null;
                error_log("Invalid period format: " . $entry['period']);
            }

            // Bind values
            $stmt->bindValue(':educ_id', $educ_idValue);
            $stmt->bindValue(':entity_no', $entity_no);
            $stmt->bindValue(':school_level', $entry['level']);
            $stmt->bindValue(':school_name', $entry['schoolName']);
            $stmt->bindValue(':date_from', $date_from);
            $stmt->bindValue(':date_to', $date_to);
            $stmt->bindValue(':school_units_earned', $entry['unitsEarned']);
            $stmt->bindValue(':year_graduated', $entry['yearGraduated']);
            $stmt->bindValue(':honors_received', $entry['honors']);
            $stmt->bindValue(':remarks', $entry['remarks']);

            // Execute the query
            $stmt->execute();
            error_log("Inserted Record: " . json_encode($entry));
        }

        $response['status'] = "success";
        $response['message'] = "Educational Record successfully inserted!";
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Logs error to php_errors.log
        $response['status'] = "error";
        $response['message'] = "Data insertion failed.";
    }

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

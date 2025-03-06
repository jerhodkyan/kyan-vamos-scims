<?php

include('../server_side/sccdrrmo_db_connection.php');

function generateEntityID($con_sccdrrmo)
{
    $template = 'XXXXXX9999';
    $entity_no = '';

    do {
        // Generate the entity ID
        $entity_no = generateRandomID($template);

        // Check if it already exists in the database
        $check_entity_sql = "SELECT COUNT(*) FROM tbl_entity WHERE entity_no = :entity";
        $check_entity_data = $con_sccdrrmo->prepare($check_entity_sql);
        $check_entity_data->execute([':entity' => $entity_no]);

        $entity_exists = $check_entity_data->fetchColumn() > 0;
    } while ($entity_exists);

    return $entity_no;
}

function generateRandomID($template)
{
    $id = '';
    foreach (str_split($template) as $char) {
        if ($char === 'X') {
            $id .= chr(rand(65, 90)); // Random uppercase letter
        } elseif ($char === '9') {
            $id .= rand(0, 9); // Random digit
        } else {
            $id .= $char; // Keep other characters as is
        }
    }
    return $id;
}

// Generate and display the entity ID
echo generateEntityID($con_sccdrrmo);

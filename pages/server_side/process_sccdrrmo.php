<?php
include('../server_side/sccdrrmo_db_connection.php');

$numberofrecords = 5;

if (!isset($_POST['searchTerm'])) {
   $stmt = $con_sccdrrmo->prepare("SELECT * FROM tbl_individual r
                                 INNER JOIN tbl_entity t ON t.entity_no = r.entity_no
                                 WHERE t.status <> 'VOID' AND t.mapping_status = 'DONE' 
                                 ORDER BY r.lastname LIMIT :limit");
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
   $stmt->execute();
   $usersList = $stmt->fetchAll();
} else {
   $search = $_POST['searchTerm'];

   $stmt = $con_sccdrrmo->prepare("SELECT * FROM tbl_individual r
                                 INNER JOIN tbl_entity t ON t.entity_no = r.entity_no
                                 WHERE (t.status <> 'VOID' AND t.mapping_status = 'DONE') AND (r.entity_no LIKE :entity_no OR CONCAT(r.firstname,' ',r.lastname) LIKE :fullname)
                                 ORDER BY r.lastname  LIMIT :limit");

   $stmt->bindValue(':entity_no', '%' . $search . '%', PDO::PARAM_STR);
   $stmt->bindValue(':fullname', '%' . $search . '%', PDO::PARAM_STR);
   $stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);

   $stmt->execute();
   $usersList = $stmt->fetchAll();
}

// Close the connection
$stmt = null;
$con_sccdrrmo = null;

$response = array();

foreach ($usersList as $user) {
   $response[] = array(
      "id" => $user['entity_no'],
      "fullname" => $user['fullname'],
      "firstname" => $user['firstname'],
      "middlename" => $user['middlename'],
      "lastname" => $user['lastname'],
      "suffix" => $user['suffix1'],
      "gender" => $user['gender'],
      "birthdate" => $user['birthdate'],
      "photo" => $user['photo'],
      "status" => $user['status'],
      "contact" => $user['mobile_no'],
      "civil_status" => $user['civil_status'],
      "religion" => $user['religion'],
      "text" => $user['entity_no'] . ' - ' . $user['fullname'],
   );
}

echo json_encode($response);
exit();

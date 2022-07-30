<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Patients.php';

$database = new Database();
$db = $database->getConnection();

$patients = new Patients($db);

$patients->id = (isset($_GET['patient_id']) && $_GET['patient_id']) ? $_GET['patient_id'] : '0';

$result = $patients->read_all();

if($result->num_rows > 0){
    $itemRecords=array();
    $itemRecords["patients"]=array();
    while ($item = $result->fetch_assoc()) {
        extract($item);
        $itemDetails=array(
            "patient_id" => $patient_id,
            "id" => $id,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "dob" => $dob,
            "date" => $date,
            "bmi" => $bmi,
        );
        $itemRecords["patients"][] = $itemDetails;
    }
    http_response_code(200);
    echo json_encode($itemRecords);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No item found.")
    );
}

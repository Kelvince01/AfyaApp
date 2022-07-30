<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../class/Patients.php';

$database = new Database();
$db = $database->getConnection();

$patients = new Patients($db);

$data = json_decode(file_get_contents("php://input"));

/**
 * @param $data
 * @param Patients $patients
 * @return void
 */
function extracted($data, Patients $patients): void
{
    $patients->firstname = $data->firstname;
    $patients->lastname = $data->lastname;
    $patients->dob = $data->dob;
    $patients->gender = $data->gender;
    $patients->date = $data->date;
}

//if(!empty($data->id) && !empty($data->firstname) &&
if(!empty($data->firstname) &&
    !empty($data->lastname) &&
    !empty($data->dob) &&
    !empty($data->gender)){

    extracted($data, $patients);

    if($patients->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Patient was created."));
    } else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create patient."));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create patient. Data is incomplete."));
}

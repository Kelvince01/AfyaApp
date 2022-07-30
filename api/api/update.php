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
   $patients->height = $data->height;
    $patients->weight = $data->weight;
    $patients->bmi = $data->bmi;
    $patients->good_health = $data->good_health;
    $patients->ever_on_diet = $data->ever_on_diet;
    $patients->comments = $data->comments;
}

//if(!empty($data->id) &&
if(!empty($data->patient_id) &&
    !empty($data->height) && !empty($data->weight) &&
    !empty($data->bmi) && !empty($data->good_health) &&
    !empty($data->ever_on_diet) && !empty($data->comments)){

    $patients->patient_id = $data->patient_id;
    extracted($data, $patients);

    if($patients->patient_visit()){
        http_response_code(200);
        echo json_encode(array("message" => "Patient visit was updated."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to update patient's visit."));
    }

} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to update patient's visit. Data is incomplete."));
}

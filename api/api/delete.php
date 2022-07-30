<?php
// include headers
header("Access-Control-Allow-Origin: *");
// data which we are getting inside request
header("Access-Control-Allow-Methods: GET");

include_once '../config/Database.php';
include_once '../class/Patients.php';

$database = new Database();
$db = $database->getConnection();

$patients = new Patients($db);

if($_SERVER['REQUEST_METHOD'] === "GET"){

    $id = $_GET['patient_id'] ?? "";

    if(!empty($id)){

        $patients->id = $id;

        if($patients->delete()){

            http_response_code(200); // OK
            echo json_encode(array(
                "status" => 1,
                "message" => "Patient deleted successfully"
            ), JSON_THROW_ON_ERROR);
        }else{

            http_response_code(500); // server error
            echo json_encode(array(
                "status" => 0,
                "message" => "Failed to delete patient"
            ), JSON_THROW_ON_ERROR);
        }
    }else{

        http_response_code(404); // data not found
        echo json_encode(array(
            "status" => 0,
            "message" => "All data needed"
        ), JSON_THROW_ON_ERROR);
    }
}else{

    http_response_code(503); // service unavialable
    echo json_encode(array(
        "status" => 0,
        "message" => "Access Denied"
    ), JSON_THROW_ON_ERROR);
}
?>

/*
// get patient id
$data = json_decode(file_get_contents("php://input"));

// set patient id to be deleted
$patients->id = $data->id;

// delete the product
if($patients->delete()){

// set response code - 200 ok
http_response_code(200);

// tell the user
echo json_encode(array("message" => "Patient was deleted."));
}

// if unable to delete the patient
else{

// set response code - 503 service unavailable
http_response_code(503);

// tell the user
echo json_encode(array("message" => "Unable to delete patient."));
}
*/

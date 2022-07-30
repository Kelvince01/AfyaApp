<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and class files
include_once '../config/core.php';
include_once '../config/Database.php';
include_once '../class/Patients.php';

// instantiate database and patient object
$database = new Database();
$db = $database->getConnection();

// initialize object
$patient = new Patients($db);

// get keywords
$keywords= $_GET["s"] ?? "";

// query patients
$stmt = $patient->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // patients array
    $patients_arr=array();
    $patients_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $patient_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        $patients_arr["records"][] = $patient_item;
    }

    // set response code - 200 OK
    http_response_code(200);

    // show patients data
    echo json_encode($patients_arr, JSON_THROW_ON_ERROR);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no patients found
    try {
        echo json_encode(array("message" => "No patients found."), JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }
}
?>

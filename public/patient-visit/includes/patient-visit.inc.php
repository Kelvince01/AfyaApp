<?php
/*if (isset($_POST['patient_id']) && $_POST['patient_id']!="") {
    $patient_id = $_POST['patient_id'];
    $url = "http://localhost:4000/api/read.php";

    $patient = curl_init($url);
    curl_setopt($patient,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($patient);

    $result = json_decode($response);
}*/

require '../../utilities/security_functions.php';
require_once '../../common/common.php';

$rest_api_base_url = 'http://127.0.0.1:4000';

if (isset($_POST['register'])) {
    /*
    * -------------------------------------------------------------------------------
    *   Securing against Header Injection
    * -------------------------------------------------------------------------------
    */

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }

    //filter POST data
    function input_filter($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    $id = input_filter($_POST['patient_id']);
    $height = input_filter($_POST['height']);
    $weight = input_filter($_POST['weight']);
    $bmi = input_filter($_POST['bmi']);
    $good_health = input_filter($_POST['good_health']);
    $ever_on_diet = input_filter($_POST['ever_on_diet']);
    $comments = input_filter($_POST['comments']);

    $data = array (
        "patient_id" => $id,
        "height" => $height,
        "weight"=> $weight,
        "bmi"=> $bmi,
        "good_health"=>$good_health,
        "ever_on_diet"=>$ever_on_diet,
        "comments"=>$comments,
    );

    //POST - create new patient
    //$post_endpoint = '/api/create';
    $post_endpoint = '/api/update.php';
    $request_data = json_encode($data);
    $response = perform_http_request('POST', $rest_api_base_url . $post_endpoint, $request_data);

    $_SESSION['STATUS']['registerstatus'] = $response->message;
    header("Location: ../../patients/");
    exit();
}
?>

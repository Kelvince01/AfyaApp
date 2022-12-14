<?php
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

    $firstname = input_filter($_POST['firstname']);
    $lastname = input_filter($_POST['lastname']);
    $dob = input_filter($_POST['dob']);
    $gender = input_filter($_POST['gender']);
    date_default_timezone_set('Africa/Nairobi');
    $curr_date = date('Y-m-d H:i:s');
    $date = $curr_date;

    $data = array (
        "firstname" => $firstname,
        "lastname"=> $lastname,
        "dob"=> $dob,
        "gender"=>$gender,
        "date"=>$date,
    );

    //POST - create new patient
    //$post_endpoint = '/api/create';
    $post_endpoint = '/api/create.php';
    $request_data = json_encode($data);
    $response = perform_http_request('POST', $rest_api_base_url . $post_endpoint, $request_data);

    $_SESSION['STATUS']['registerstatus'] = $response->message;
    header("Location: ../../patient-visit/");
    exit();
}
?>



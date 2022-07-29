<?php

if (isset($_POST['patient_id']) && $_POST['patient_id']!="") {
    $patient_id = $_POST['patient_id'];
    $url = "http://localhost:7000/api.php?".$patient_id;

    $patient = curl_init($url);
    curl_setopt($patient,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($patient);

    $result = json_decode($response);

    echo "<table>";
    echo "<tr><td>Patient ID:</td><td>$result->patient_id</td></tr>";
    echo "<tr><td>Amount:</td><td>$result->amount</td></tr>";
    echo "<tr><td>Response Code:</td><td>$result->response_code</td></tr>";
    echo "<tr><td>Response Desc:</td><td>$result->response_desc</td></tr>";
    echo "</table>";
}
?>



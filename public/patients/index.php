<?php
declare(strict_types=1);

const TITLE = "Patients";
include '../includes/header.php';

$url = "http://127.0.0.1:4000/api/read_all.php";

$patient = curl_init($url);
curl_setopt($patient,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($patient);

$result = json_decode($response, true);
?>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: center;
        padding: 8px;
    }

    th {
        background-color: skyblue;
    }

    tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: aliceblue;
    }

    #patientVisitsTable {
        border-collapse: collapse; /* Collapse borders */
        width: 100%; /* Full-width */
        border: 1px solid #ddd; /* Add a grey border */
        font-size: 18px; /* Increase font-size */
    }

    #patientVisitsTable th, #patientVisitsTable td {
        text-align: left; /* Left-align text */
        padding: 12px; /* Add padding */
    }

    #patientVisitsTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
    }

    #patientVisitsTable tr.header, #patientVisitsTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #f1f1f1;
    }
</style>

<main role="main" class="container">

    <div class="row">
        <div class="col-sm-9">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="../assets/images/logowhite.png" alt="" width="48" height="48">
                <div class="lh-100">
                    <h6 class="mb-0 text-white lh-100">Patient Report</h6>
                </div>
            </div>

            <div-- class="my-3 p-3 bg-white rounded box-shadow">
                <h5 class="mb-3">Patient Report</h5>

                <div class="row">
                    <div class="col-md-3">
                        <h4>Date from</h4>
                        <input type="date" class="form-control" id="datefilterfrom" data-date-split-input="true">
                    </div>
                    <div class="col-md-3">
                        <h4>Date to</h4>
                        <input type="date" class="form-control" id="datefilterto" data-date-split-input="true">
                    </div>
                </div>

                <?php

                echo "<table class='table table-hover table-responsive table-bordered' id='patientVisitsTable'>";
                echo "<tr>";
                echo "<th>Full Names</th>";
                echo "<th>Age</th>";
                echo "<th hidden>Date</th>";
                echo "<th>BMI Status</th>";
                echo "<th>Actions</th>";
                echo "</tr>";
                foreach ( $result["patients"] as $row){
                //while ($row = $result){
                    extract($row);
                    //echo $firstname;
                    echo "<tr>";
                    echo "<td>{$firstname} {$lastname}</td>";
                    $newDate = date("d-m-Y", strtotime($date));
                    echo "<input type='date' id='filter_date' name='filter_date' value='".$newDate."' hidden>";
                    $age = date_diff(date_create($dob), date_create('now'))->y;
                    echo "<td>{$age}</td>";
                    echo "<td class='filter_d sr-only' hidden>{$newDate}</td>";

                    if ($bmi <= 18.5) {
                        $output = "UNDERWEIGHT";
                    } else if ($bmi > 18.5 AND $bmi<=24.9 ) {
                        $output = "NORMAL WEIGHT";
                    } else if ($bmi > 24.9 AND $bmi<=29.9) {
                        $output = "OVERWEIGHT";
                    } else if ($bmi > 30.0) {
                        $output = "OBESE";
                    }

                    echo "<td>{$output}</td>";

                    echo "<td>";
                    // read, edit and delete buttons
                    echo "<a href='../patient/index.php?id={$patient_id}' class='btn btn-primary left-margin'>
                        <span class='glyphicon glyphicon-list'></span> Read
                    </a>

                    <a href='../patient-edit/index.php?id={$patient_id}' class='btn btn-info left-margin'>
                        <span class='glyphicon glyphicon-edit'></span> Edit
                    </a>

                    <a delete-id='{$patient_id}' class='btn btn-danger delete-object'>
                        <span class='glyphicon glyphicon-remove'></span> Delete
                    </a>";
                    echo "</td>";

                    echo "</tr>";
                }

                echo "</table>";

                ?>
            </div>

        </div>
    </div>
</main>

<?php

include '../includes/footer.php'

?>

<script type="text/javascript">
    function filterRows() {
        var from = $('#datefilterfrom').val();
        var to = $('#datefilterto').val();

        if (!from && !to) { // no value for from and to
            return;
        }

        from = from || '1970-01-01'; // default from to a old date if it is not set
        to = to || '2999-12-31';

        var dateFrom = moment(from);
        var dateTo = moment(to);

        $('#patientVisitsTable tr').each(function(i, tr) {
            var val = $(tr).find("td:nth-child(3)").text();
            console.log(val);
            var dateVal = moment(val, "DD/MM/YYYY");
            var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
            $(tr).css('display', visible);
        });
    }

    $('#datefilterfrom').on("change", filterRows);
    $('#datefilterto').on("change", filterRows);
</script>

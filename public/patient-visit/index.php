<?php
declare(strict_types=1);

const TITLE = "Patient Visit";
include '../includes/header.php';

function bmi_index($height, $weight) {
    $inches = $height*0.393701;
    $pound = $weight*2.2;

    return round(bmi($pound, $inches)*703, 2);
}

function bmi($mass,$height) {
    return $mass/($height*$height);
}

$url = "http://127.0.0.1:4000/api/read.php";

$patient = curl_init($url);
curl_setopt($patient,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($patient);

$result = json_decode($response, true);
?>

<style>
    /* Style the form */
    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        padding: 40px;
        width: 70%;
        min-width: 300px;
    }

    /* Style the input fields */
    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #04AA6D;
    }

    textarea {
        min-height: 150px;
    }

    #add_patient_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>

<div class="container">
    <div class="row">
        <!--div class="col-md-4 mt-5">
            <form action="" method="POST">
                <label>Patient ID:</label><br />
                <label>
                    <input type="number" name="patient_id" placeholder="Enter Patient ID e.g., 1" required/>
                </label>
                <br /><br />
                <button type="submit" name="check">Check</button>
            </form>
        </div-->
        <div class="col-lg-4">
            <form class="form-auth regForm" id="add_patient_form" action="/patient-visit/includes/patient-visit.inc.php" method="post" enctype="multipart/form-data">
                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Patient Visit</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                        if (isset($_SESSION['STATUS']['registerstatus']))
                            echo $_SESSION['STATUS']['registerstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="height">Patient</label>
                <select class="select2 form-control" data-rel="chosen"  name="patient_id" id="selectError">
                    <?php
                    foreach ($result['patients'] as $row) {
                        extract($row); ?>
                        <option value="<?php echo $patient_id;?>"><?php echo $firstname . ' ' . $lastname;?></option>
                    <?php }
                    ?>
                </select>
                </div>

                <fieldset>
                    <div class="form-group">
                        <label for="height">Height (cm)</label>
                        <input type="number" id="height" name="height" class="form-control" placeholder="170" oninput="this.className = ''">
                        <input type="number" id="id" name="id" class="form-control" value="<?php echo $p_id ?>" hidden>
                    </div>

                    <div class="form-group">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" placeholder="60" oninput="calculate()">
                    </div>

                    <div class="form-group">
                        <label for="bmi">BMI</label>
                        <input type="number" id="bmi" name="bmi" class="form-control" placeholder="25.0" readonly>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="button" id="proceed" name='proceed'>Proceed</button>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label>General Health?</label>

                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="good" name="good_health" class="custom-control-input" value="g">
                            <label class="custom-control-label" for="good">Good</label>
                        </div>
                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="poor" name="good_health" class="custom-control-input" value="p">
                            <label class="custom-control-label" for="poor">Poor</label>
                        </div>
                    </div>

                    <div class="form-group sr-only" id="on_diet">
                        <label>Have you ever been on diet to loose weight?</label>

                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="yes" name="ever_on_diet" class="custom-control-input" value="y">
                            <label class="custom-control-label" for="yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="no" name="ever_on_diet" class="custom-control-input" value="n">
                            <label class="custom-control-label" for="no">No</label>
                        </div>
                    </div>

                    <div class="form-group sr-only" id="taking_drugs">
                        <label>Are you currently taking any drugs?</label>

                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="yes" name="ever_on_diet" class="custom-control-input" value="y">
                            <label class="custom-control-label" for="yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control">
                            <input type="radio" id="no" name="ever_on_diet" class="custom-control-input" value="n">
                            <label class="custom-control-label" for="no">No</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea type="text" id="comments" name="comments" class="form-control" placeholder="Tell us more..."></textarea>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" id="register" type="submit" name='register'>Register</button>
                </fieldset>

                <p class="mt-4 mb-3 text-muted text-center">
                    <a href="https://github.com/Kelvince01/AfyaApp" target="_blank">
                        Afya App
                    </a> |
                    <a href="https://github.com/Kelvince01/AfyaApp/blob/master/LICENSE" target="_blank">
                        MIT License
                    </a>
                </p>

            </form>

        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>

<?php

include '../includes/footer.php';

?>
<script type="text/javascript">
    $('.select2').select2({});
    console.log("Testing...");
</script>

<script type="text/javascript">
    let global_bmi;
    $(document).ready(function(){
        var current = 1,current_step,next_step,steps;
        steps = $("fieldset").length;
        $("#proceed").on('click', function(){
            current_step = $(this).parent();
            //if (!validateForm()) return false;
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();

            //console.log(global_bmi);
            if (global_bmi < 25) {
                 $("#on_diet").removeClass('sr-only')
            } else {
                $("#taking_drugs").removeClass('sr-only')
            }
        });
    });
</script>

<script type="text/javascript">
    function bmi_index($height, $weight) {
        let $inches = $height * 0.393701;
        let $pound = $weight * 2.2;

        return Math.round((bmi($pound, $inches)*703));
    }

    function bmi($mass,$height) {
        return $mass/($height*$height);
    }

    function calculate() {
        var bmi;
        var height = parseInt($('#height').val());
        var weight = parseInt($('#weight').val());
        bmi = (weight / Math.pow((height/100), 2)).toFixed(1)
        $("#bmi").val(bmi);
        global_bmi = bmi;
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByName("fieldset");
        y = x[1].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
            }
        }

        return valid; // return the valid status
    }
</script>

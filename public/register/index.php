<?php
declare(strict_types=1);

const TITLE = "Register Patient";
include '../includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-lg-4">
            <form class="form-auth" action="/register/includes/register.inc.php" method="post" enctype="multipart/form-data">
                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Register Patient</h6>
                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                        if (isset($_SESSION['STATUS']['registerstatus']))
                            echo $_SESSION['STATUS']['registerstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="e.g., Kelvin" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="e.g., Maina" required>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="m">
                        <label class="custom-control-label" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f">
                        <label class="custom-control-label" for="female">Female</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date" class="sr-only">Date</label>
                    <input type="date" id="date" name="date" class="form-control" hidden>
                </div>

                <hr>

                <button class="btn btn-lg btn-primary btn-block" type="submit" name='register'>Register</button>

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

include '../includes/footer.php'

?>

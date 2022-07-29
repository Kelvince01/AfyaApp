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

            <!--form action="" method="POST">
                <label>Enter Patient ID:</label><br />
                <label>
                    <input type="text" name="patient_id" placeholder="Enter Patient ID" required/>
                </label>
                <br /><br />
                <button type="submit" name="submit">Submit</button>
            </form-->

            <form class="form-auth" action="includes/register.inc.php" method="post" enctype="multipart/form-data">
                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Register Patient</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                        if (isset($_SESSION['STATUS']['signupstatus']))
                            echo $_SESSION['STATUS']['signupstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                    <sub class="text-danger">
                        <?php
                        if (isset($_SESSION['ERRORS']['usernameerror']))
                            echo $_SESSION['ERRORS']['usernameerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="email" class="sr-only">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
                    <sub class="text-danger">
                        <?php
                        if (isset($_SESSION['ERRORS']['emailerror']))
                            echo $_SESSION['ERRORS']['emailerror'];

                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirmpassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                    <sub class="text-danger mb-4">
                        <?php
                        if (isset($_SESSION['ERRORS']['passworderror']))
                            echo $_SESSION['ERRORS']['passworderror'];

                        ?>
                    </sub>
                </div>

                <hr>
                <span class="h5 mb-3 font-weight-normal text-muted text-center">Optional</span>
                <br><br>

                <div class="form-group">
                    <label for="first_name" class="sr-only">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name">
                </div>

                <div class="form-group">
                    <label for="last_name" class="sr-only">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name">
                </div>

                <div class="form-group mt-4">
                    <label for="headline" class="sr-only">Headline</label>
                    <input type="text" id="headline" name="headline" class="form-control" placeholder="headline">
                </div>

                <div class="form-group">
                    <label for="bio" class="sr-only">Profile Details</label>
                    <textarea type="text" id="bio" name="bio" class="form-control" placeholder="Tell us about yourself..."></textarea>
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

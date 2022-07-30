<?php
declare(strict_types=1);

const TITLE = "Contact Us";
include '../includes/header.php';
?>

<main role="main" class="container mt-6">

    <div class="row">
                <div class="col-sm-9 px-5">

            <form class="form-auth" action="includes/contact.inc.php" method="post">

                <h6 class="h3 mb-3 font-weight-normal text-muted  text-center">Contact Us</h6>

                <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="message" class="sr-only">Message</label>
                    <textarea type="password" id="message" name="message" class="form-control message" placeholder="Message" required></textarea>
                </div>

                <div class="text-center mx-5 px-5">
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="contact-submit" value="contact-submit">Submit</button>
                </div>

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
    </div>
</main>

<?php

include '../includes/footer.php'

?>

<!--Login Page: Input username/email and password-->

<?php
require 'includes/header.php';
?>

<main>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <div class="bg-cover">
        <div class="container">
            <div class="h-40 center-me">
                <div class="my-auto">
                    <form class="form-signin" action="includes/login-helper.php" method="post">

                        <h1 class="h3 mb-3 font-weight-normal big-font">
                            Login
                        </h1>

                        <input type="text" class="form-control" name="uname-email" placeholder="Username/Email" required>

                        <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password" required>

                        <button class="btn btn-lg btn-outline-dark btn-block medium-font" name="login-submit" type="submit">
                            Log in
                        </button>

                        <a href="signup.php">Don't have an account?<a>

                                <p class="mt-5 mb-3 text-black">
                                    &copy; 2021
                                </p>
                    </form>
                </div>
            </div>
        </div>
</main>
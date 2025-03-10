<?php
    session_start();
    // Include the database connection file
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JUMPA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body>
        <div class="login-container">
            <div class="login-form-container">
                <a href="../index.php">
                    <div class="login-img">
                        <img src="../assets/images/jumpa-logo-with-word.png" alt="Jumpa Logo" class="login-logo">
                    </div>
                </a>
                <form action="signin_process.php" method="POST" id="sign-in">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" class="btn btn-danger w-full d-flex justify-content-center mx-auto px-5 sign-in-button">Sign In</button>

                    <!-- Signing in with google - under construction -->

                    <!-- <p class="text-center sign-in-p">Or sign in with:</p>
                    <div class="external-signin-links">
                        <div class="google-img">
                            <img src="../assets/images/1298745_google_brand_branding_logo_network_icon.svg" alt="google-image">
                        </div>
                        <div class="facebook-img">
                            <img src="../assets/images/5296499_fb_facebook_facebook logo_icon.svg" alt="facebook-image">
                        </div>
                    </div> -->
                    <div class="mt-2 text-center">
                        <a href="signup.php">Don't have an account? Sign up</a>
                    </div>
                </form>

                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger mt-2'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success mt-2'>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']); // Clear the error message
                    }
                ?>
            </div>
            <div class="login-image-container"></div>
        </div>
    </body>
</html>
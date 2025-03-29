<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - JUMPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

    <!-- PNG Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">

    <!-- Apple Touch Icon (for iPhones/iPads) -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">

    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../assets/favicon/android-chrome-512x512.png">

</head>

<body>
    <div class="signup-container">
        <div class="signup-form-container">
            <a href="../index.php">
                <div class="login-img">
                    <img src="../assets/images/jumpa-logo-with-word.png" alt="Jumpa Logo" class="login-logo">
                </div>
            </a>
            <form action="signup_process.php" method="post">
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                        placeholder="Confirm Password" required>
                    <label for="confirmpassword">Confirm Password</label>
                </div>
                <button type="submit" class="sign-in-button" name="signup-submit">Sign
                    Up</button>
                <!-- <p class="text-center mt-2">Or sign up with:</p>
                <div class="external-signin-links">
                    <div class="google-img">
                        <img src="../assets/images/1298745_google_brand_branding_logo_network_icon.svg" alt="google-image">
                    </div>
                    <div class="facebook-img">
                        <img src="../assets/images/5296499_fb_facebook_facebook logo_icon.svg" alt="facebook-image">
                    </div>
                </div> -->
                <div class="mt-2 text-center">
                    <a href="login.php">Already have an account? Log in</a>
                </div>
            </form>

            <?php
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-success mt-3'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <div class="signup-image-container"></div>
    </div>
</body>

</html>
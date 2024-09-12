<?php
    session_start();
    // Include the database connection file
    include "php/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>JUMPA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="login-container">
            <div class="form-container">
                <h1>Login to JUMPA</h1>
                <form action="php/signin_process.php" method="get" id="sign-in">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Sign In</button>
                    <p class="text-center mt-3">Or sign in with:</p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-google btn-danger">Google</button>
                        <button class="btn btn-facebook btn-primary">Facebook</button>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="signup.php">Don't have an account? Sign up</a>
                    </div>
                </form>

                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger mt-3'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            <div class="image-container"></div>
        </div>

        <?php
            // Display the error message if set
            // if (isset($_SESSION['error'])) {
            //     echo '<p class="center" style="top:250px;font-size: 16px; font-weight: bolder;position: absolute;color:red;">' . $_SESSION['error'] . '</p>';
            //     unset($_SESSION['error']); // Clear the error message
            // }
        ?>

        <?php
            // Display the error message if set
            // if (isset($_SESSION['message'])) {
            //     echo '<p class="center" style="font-size: 16px; font-weight: bolder;position: absolute;color:white;">' . $_SESSION['message'] . '</p>';
            //     unset($_SESSION['message']); // Clear the error message
            // }
        ?>

        <!-- <form action="php/signup_process.php" method="get" id="sign-up" class="center">
            <input type="text" name="username" placeholder="Username" class="input-field">
            <input type="password" name="password" placeholder="Password" class="input-field">
            <input type="password" name="confirmpassword" placeholder="Confirm Password" class="input-field">
            <input type="submit" value="Sign Up!" class="input-field">
        </form> -->
    </body>
</html>
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
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <form action="php/signin_process.php" method="get" id="sign-in" class="center">
            <input type="text" name="username" placeholder="Username" class="input-field">
            <input type="password" name="password" placeholder="Password" class="input-field">
            <input type="submit" value="Sign In!" class="input-field">
        </form>

        <?php
            // Display the error message if set
            if (isset($_SESSION['error'])) {
                echo '<p class="center" style="top:250px;font-size: 16px; font-weight: bolder;position: absolute;color:red;">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']); // Clear the error message
            }
        ?>

        <?php
            // Display the error message if set
            if (isset($_SESSION['message'])) {
                echo '<p class="center" style="font-size: 16px; font-weight: bolder;position: absolute;color:white;">' . $_SESSION['message'] . '</p>';
                unset($_SESSION['message']); // Clear the error message
            }
        ?>

        <form action="php/signup_process.php" method="get" id="sign-up" class="center">
            <input type="text" name="username" placeholder="Username" class="input-field">
            <input type="password" name="password" placeholder="Password" class="input-field">
            <input type="password" name="confirmpassword" placeholder="Confirm Password" class="input-field">
            <input type="submit" value="Sign Up!" class="input-field">
        </form>
    </body>
</html>
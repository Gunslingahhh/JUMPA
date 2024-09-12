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
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="signup-container">
        <div class="form-container">
            <h1>Sign Up for JUMPA</h1>
            <form action="php/signup_process.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                    <label for="confirmpassword">Confirm Password</label>
                </div>
                <button type="submit" class="btn btn-danger w-100">Sign Up</button>
                <p class="text-center mt-3">Or sign up with:</p>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-google btn-danger">Google</button>
                    <button class="btn btn-facebook btn-primary">Facebook</button>
                </div>
                <div class="mt-3 text-center">
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
        <div class="image-container"></div>
    </div>
</body>
</html>

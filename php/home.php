<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <?php
        include "topnav.php";
    ?>

    <div id="homepage_container" class="center">
        <?php
            echo "User ID: " . $_SESSION['user_id'] . "<br>";
            echo "Welcome back, " . $_SESSION['username'];
        ?>
        <br>
        <button>Create Post</button>
        <button>Messages</button>
        <button>Job Board</button>
        <button>Payments</button>
    </div>
</body>
</html>

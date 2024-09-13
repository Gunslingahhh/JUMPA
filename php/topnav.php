<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/topnav.css">
    </head>
    <body>
        <div id="topnav">
            <a href="home.php">
                <img src="../assets/LOGO.png">
            </a>
            <h2>JUMPA</h2>
            <a href="logout.php" id="logout">LOGOUT</a>
        </div>
    </body>
</html>

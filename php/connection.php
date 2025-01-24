<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    /* $servername = "localhost:3306";
    $username = "JUMPA_admin";
    $password = "2Ys0!2eo1"; */
    
  // Create connection
    $conn = mysqli_connect($servername, $username, $password, "jumpa");

  //Check connection
  /* if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully"; */
?>
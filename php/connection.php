<?php
$servername = "localhost:3306"; 
$username = "JUMPA_admin";
$password = "2Ys0!2eo1";
$dbname = "jumpa";

// For coding on personal device purposes
/* $servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "jumpa"; */

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db($dbname);
} else {
    die("Error creating database: " . $conn->error);
}

// SQL to create tables without foreign keys
$tables = [
  "CREATE TABLE IF NOT EXISTS user (
      user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      user_username VARCHAR(255) NOT NULL,
      user_password VARCHAR(255) NOT NULL,
      user_salt VARCHAR(255) NOT NULL,
      user_email VARCHAR(255) NOT NULL,
      user_fullname VARCHAR(255) NOT NULL,
      user_gender VARCHAR(255) NOT NULL,
      user_age INT(10) NOT NULL,
      user_ic VARCHAR(255) DEFAULT NULL,
      user_contactNumber VARCHAR(255) NOT NULL,
      user_photo VARCHAR(255) NOT NULL,
      user_qualification VARCHAR(255) NOT NULL,
      user_certificate VARCHAR(255) NOT NULL,
      user_race VARCHAR(255) NOT NULL,
      user_religion VARCHAR(255) NOT NULL,
      user_language VARCHAR(255) NOT NULL,
      user_workingExperienceWithJumpa VARCHAR(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
  
  "CREATE TABLE IF NOT EXISTS task (
      task_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      task_photo VARCHAR(255) NOT NULL,
      task_title VARCHAR(255) NOT NULL,
      task_description VARCHAR(255) NOT NULL,
      task_date DATE NOT NULL,
      task_duration VARCHAR(255) NOT NULL,
      task_location VARCHAR(255) NOT NULL,
      task_toolsRequired VARCHAR(255) NOT NULL,
      task_pax INT(10) NOT NULL,
      task_price INT(10) NOT NULL,
      task_dressCode VARCHAR(255) NOT NULL,
      task_gender VARCHAR(255) NOT NULL,
      task_nationality VARCHAR(255) NOT NULL,
      task_ageRange VARCHAR(255) NOT NULL,
      task_muslimFriendly TINYINT(1) NOT NULL,
      task_foodProvision TINYINT(1) NOT NULL,
      task_transportProvision TINYINT(1) NOT NULL,
      task_status TINYINT(1) NOT NULL DEFAULT 1,
      user_id INT(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
  
  "CREATE TABLE IF NOT EXISTS bidding (
      bidding_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      task_id INT(11) NOT NULL,
      user_id INT(11) NOT NULL,
      bidding_amount DECIMAL(10,2) NOT NULL,
      bidding_time TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;",
  
  "CREATE TABLE IF NOT EXISTS job (
      job_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      user_id INT(11) NOT NULL,
      task_id INT(11) NOT NULL,
      bidding_id INT(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;"
];

// Execute each SQL statement
foreach ($tables as $sql) {
  if ($conn->query($sql) !== TRUE) {
      echo "Error creating table: " . $conn->error;
  }
}


// Check if the database already has data
$checkQuery = "SELECT COUNT(*) as count FROM task";  // Change 'task' to a table that must have data
$result = $conn->query($checkQuery);
$row = $result->fetch_assoc();

if ($row['count'] == 0) { // If the table is empty, load dummy data
    $sqlFile = __DIR__ . "/dummy_data.sql";
    if (file_exists($sqlFile)) {
        $sqlContent = file_get_contents($sqlFile);
        if ($conn->multi_query($sqlContent)) {
            do {
                // Process multiple queries
            } while ($conn->more_results() && $conn->next_result());
        }
    }
}
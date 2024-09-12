<?php
// Start the session
session_start();

// Include database connection
include 'connection.php';

// Get the username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the credentials are valid
$sql = "SELECT user_id FROM user WHERE BINARY user_username = ? AND user_password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Credentials are valid, fetch user_id and set session variables
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];

    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;

    // Redirect to the welcome page
    header("Location: user_home.php");
    exit();
} else {
    // Credentials are invalid, set an error message and redirect back to the login page
    $_SESSION['error'] = 'Salah maklumat log masuk. Sila cuba lagi.';
    header("Location: ../index.php");
    exit();
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>

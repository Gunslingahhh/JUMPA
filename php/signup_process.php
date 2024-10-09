<?php
    session_start();
    

    include "connection.php";

    if(isset($_POST['signup-submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        
        // Validate password confirmation
        if ($_POST['password'] !== $_POST['confirmpassword']) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: ../index.php");
            exit();
        }

        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE user_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Username already exists.";
            header("Location: ../index.php");
            exit();
        }
        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO user(user_username, user_password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful!";
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error'] = "Error registering user: " . $stmt->error;
            header("Location: ../index.php");
            exit();
        }

        $stmt->close();
}

$conn->close();
?>
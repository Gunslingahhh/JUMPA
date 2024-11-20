<?php
    session_start();

    include "connection.php";

    if(isset($_POST['signup-submit'])){
        $username=$_POST['username'];
        $salt = bin2hex(random_bytes(16));
        $password = hash('sha256',$_POST['password'] . $salt);
        $confirmpassword = hash('sha256',$_POST['confirmpassword'] . $salt);
        
        // Validate password confirmation
        if ($password !== $confirmpassword) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: ../index.php");
            exit();
        }

        // Check if username already exists
        $stmt = $conn->prepare("SELECT user_username FROM user WHERE user_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Username already exists.";
            header("Location: ../index.php");
            exit();
        }

        // Insert user data into the database
        $stmt = $conn->prepare("INSERT INTO user(user_username, user_password, user_salt, user_ic) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $salt, $icnumber);
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
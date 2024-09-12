<?php
    session_start();
    

    include "connection.php";

    if(isset($post['submit'])){
        $username=$post['username'];
        $password=$post['password'];

        $stmt=$conn->prepare("INSERT INTO user(user_username, user_password) VALUES (?,?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            $_SESSION['message'] = 'Pengguna telah didaftar. Sila log masuk';
            header("Location: ../index.php");
            exit();
        } else {
            // Registration failed, show an error message
            echo "Error: " . $stmt->error;
        }
        // Close the statement
        $stmt->close();
    }
    // Close the database connection
    $conn->close();
?>

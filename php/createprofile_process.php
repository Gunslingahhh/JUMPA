<?php
session_start();

include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $age = (int)$_POST['age'];
    $contact = $_POST['contact'];
    $race = $_POST['race'];
    $religion = $_POST['religion'];
    $language = $_POST['language'];

    if ($email && $fullname && $gender && $age && $contact && $race && $religion && $language) {
        $_SESSION['message'] = "Your profile has been successfully submitted!";
        
        header("Location: createprofile.php");
        exit;
    } else {
        $_SESSION['message'] = "Please fill in all the required fields correctly.";
        header("Location: createprofile.php");
        exit;
    }
}
?>

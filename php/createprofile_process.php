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
    $icnumber = hash('sha256',$_POST['icnumber']);

    // Check if IC Number already exists
    $icCheckerStmt = $conn->prepare("SELECT user_ic FROM user WHERE user_ic = ?");
    $icCheckerStmt->bind_param("s", $icnumber);
    $icCheckerStmt->execute();
    $icCheckerResult = $icCheckerStmt->get_result();
    if ($icCheckerResult->num_rows > 0){
        $_SESSION['message'] = "This IC number is already registered.";
        header("Location: createprofile.php");
        exit();
    }

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

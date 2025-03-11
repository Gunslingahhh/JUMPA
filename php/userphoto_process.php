<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "User ID is not set in session.";
    header("Location: editprofile.php");
    exit();
}

date_default_timezone_set('Asia/Kuching');
$user_id = $_SESSION['user_id'];
$allowed_types = ['jpg', 'png', 'jpeg'];
$target_dir = "../assets/uploads/profile_picture/";

// Ensure upload directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0775, true);
}

if (!isset($_FILES["user-photo-filename"]) || $_FILES["user-photo-filename"]["error"] != UPLOAD_ERR_OK) {
    // No file uploaded, clear profile photo
    $target_file = "";
    $sql = "UPDATE user SET user_photo = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $target_file, $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Your profile picture has been updated.";
    header("Location: editprofile.php");
    exit();
}

// Get file extension
$file_extension = strtolower(pathinfo($_FILES['user-photo-filename']['name'], PATHINFO_EXTENSION));

if (!in_array($file_extension, $allowed_types)) {
    $_SESSION['message'] = "Invalid file type. Only JPG and PNG are allowed.";
    header("Location: editprofile.php");
    exit();
}

// Generate unique filename
$newfilename = "profilePicture_user_" . $user_id . "_" . time() . "." . $file_extension;
$target_file = $target_dir . $newfilename;

// Move uploaded file
if (!move_uploaded_file($_FILES['user-photo-filename']['tmp_name'], $target_file)) {
    $_SESSION['message'] = "Error uploading file.";
    header("Location: editprofile.php");
    exit();
}

// Update database with new profile photo path
$sql = "UPDATE user SET user_photo = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $target_file, $user_id);
$stmt->execute();
$stmt->close();
$conn->close();

$_SESSION['message'] = "Your profile picture has been updated.";
header("Location: editprofile.php");
exit();
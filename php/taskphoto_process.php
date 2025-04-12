<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id'])) {
  $_SESSION['message'] = "User ID is not set in session.";
  header("Location: jobboard.php");
  exit();
}

date_default_timezone_set('Asia/Kuching');
$user_id = $_SESSION['user_id'];
$allowed_types = ['jpg', 'png', 'jpeg'];
$target_dir = "../assets/uploads/task_photo/";
$taskId = $_POST['task_id'];

// Ensure upload directory exists
if (!is_dir($target_dir)) {
  mkdir($target_dir, 0775, true);
}

if (!isset($_FILES["task-photo-filename"]) || $_FILES["task-photo-filename"]["error"] != UPLOAD_ERR_OK) {
  // No file uploaded, clear task photo
  $target_file = "";
  $sql = "UPDATE task SET task_photo = ? WHERE task_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $target_file, $taskId);
  $stmt->execute();
  $stmt->close();

  $_SESSION['message'] = "Your task picture has been updated.";
  header("Location: editpost.php" . $taskId);
  exit();
}

// Get file extension
$file_extension = strtolower(pathinfo($_FILES['task-photo-filename']['name'], PATHINFO_EXTENSION));

if (!in_array($file_extension, $allowed_types)) {
  $_SESSION['message'] = "Invalid file type. Only JPG and PNG are allowed.";
  header("Location: editpost.php" . $taskId);
  exit();
}

// Generate unique filename
$newfilename = "taskPicture" . $user_id . "_" . time() . "." . $file_extension;
$target_file = $target_dir . $newfilename;

// Move uploaded file
if (!move_uploaded_file($_FILES['task-photo-filename']['tmp_name'], $target_file)) {
  $_SESSION['message'] = "Error uploading file.";
  header("Location: editpost.php" . $taskId);
  exit();
}

// Update database with new profile photo path
$sql = "UPDATE task SET task_photo = ? WHERE task_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $target_file, $taskId);
$stmt->execute();
$stmt->close();
$conn->close();

$_SESSION['message'] = "Your task picture has been updated.";
header("Location: editpost.php?task_id=" . $taskId);
exit();

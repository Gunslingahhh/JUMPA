<?php
session_start();

include "connection.php";

if (isset($_POST['editpost-submit'])) {
  $taskId = $_POST['task_id'];
  $tasktitle = $_POST['tasktitle'];
  $taskdescription = $_POST['taskdescription'];
  $taskdate = $_POST['taskdate'];
  $taskduration = $_POST['taskduration'];
  $tasklocation = $_POST['tasklocation'];
  $toolsrequired = $_POST['toolsrequired'];
  $pax = $_POST['pax'];
  $price = $_POST['price'];
  $dresscode = $_POST['dresscode'];
  $gender = $_POST['gender'];
  $nationality = $_POST['nationality'];
  $minAge = $_POST['minAge'];
  $maxAge = $_POST['maxAge'];
  $muslimfriendly = $_POST['muslimfriendly'];
  $foodProvision = $_POST['foodprovision'];
  $transportProvision = $_POST['transportprovision'];
  $userid = $_SESSION['user_id'];
  date_default_timezone_set('Asia/Kuching');
  $image_createdAt = date("dmYHis");
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("UPDATE task SET  
    task_title = ?,  
    task_description = ?,  
    task_date = ?,  
    task_duration = ?,  
    task_location = ?,  
    task_toolsRequired = ?,  
    task_pax = ?,  
    task_price = ?,  
    task_dressCode = ?,  
    task_gender = ?,  
    task_nationality = ?,  
    task_minAge = ?,  
    task_maxAge = ?,  
    task_muslimFriendly = ?,  
    task_foodProvision = ?,  
    task_transportProvision = ?  
    WHERE task_id = ?");

  // Bind the parameters, note the order must correspond to the SQL statement  
  $stmt->bind_param(
    "ssssssiissssssiii",  // Ensure the types match; "i" at the end for task_id  
    $tasktitle,
    $taskdescription,
    $taskdate,
    $taskduration,
    $tasklocation,
    $toolsrequired,
    $pax,
    $price,
    $dresscode,
    $gender,
    $nationality,
    $minAge,
    $maxAge,
    $muslimfriendly,
    $foodProvision,
    $transportProvision,
    $taskId  // This is the `task_id` for the WHERE condition  
  );

  if ($stmt->execute()) {
    $_SESSION['message'] = "Task posted successfully!";
    header("Location: jobboard.php");
    exit();
  } else {
    $_SESSION['error'] = "Error posting task: " . $stmt->error;
    header("Location: jobboard.php");
    exit();
  }
}

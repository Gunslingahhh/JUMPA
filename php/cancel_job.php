<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['task_id'])) {

    $task_id = filter_var($_GET['task_id'], FILTER_VALIDATE_INT);

    $statusUpdate = $conn->prepare("UPDATE task SET task_status='3' WHERE task_id=?");
    $statusUpdate->bind_param("i", $task_id);

    if($statusUpdate->execute()){
        $_SESSION["message"] = "You have successfully cancelled the job.";
        header("Location: jobboard.php");
    }else{
        $_SESSION["error"] = "There is something wrong with your request. Please try again.";
        header("Location: jobboard.php");
    }
}
?>
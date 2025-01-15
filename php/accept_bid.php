<?php
session_start();
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['bidding_id']) && isset($_GET['task_id']) && isset($_GET['user_id'])) {

    $bidding_id = filter_var($_GET['bidding_id'], FILTER_VALIDATE_INT);
    $task_id = filter_var($_GET['task_id'], FILTER_VALIDATE_INT);
    $user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);

    $jobInsert = $conn->prepare("INSERT INTO job(user_id, task_id, bidding_id) VALUES (?, ?, ?)");
    $jobInsert->bind_param("iii", $user_id, $task_id, $bidding_id);

    if ($jobInsert->execute()){
        $statusUpdate = $conn->prepare("UPDATE task SET task_status='1' WHERE task_id=?");
        $statusUpdate->bind_param("i", $task_id);

        if($statusUpdate->execute()){
            $_SESSION["message"] = "You have accepted the employee.";
            header("Location: jobboard.php");
        }else{
            $_SESSION["error"] = "There is something wrong with you request. Please try again.";
            header("Location: jobboard.php");
        }
    }else{
        //Do nothing
    }
}
?>
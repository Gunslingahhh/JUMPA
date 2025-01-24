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
        $taskPax = $conn->prepare("SELECT t.task_pax
                                FROM job j
                                INNER JOIN task t ON t.task_id = j.task_id
                                WHERE t.task_id=?");
        $taskPax->bind_param("i", $task_id);
        if($taskPax->execute()){
            $taskResult=$taskPax->get_result();
            if ($pax = $taskResult->fetch_assoc()) {
                $paxLimit = $pax['task_pax'];
            
                $countTask = $conn->prepare("SELECT COUNT(task_id) AS task_count FROM job WHERE task_id = ?"); // Corrected SQL
                $countTask->bind_param("i", $task_id);
            
                if ($countTask->execute()) {
                    $countTaskResult = $countTask->get_result();
                    if ($countRow = $countTaskResult->fetch_assoc()) { // Fetch the count
                        $taskCount = $countRow['task_count'];
                        $slotLeft = $paxLimit - $taskCount;
            
                        if ($slotLeft == 0){
                            $statusUpdate = $conn->prepare("UPDATE task SET task_status='1' WHERE task_id=?");
                            $statusUpdate->bind_param("i", $task_id);

                            if ($statusUpdate->execute()){
                                $_SESSION['message']="Full user for the task";
                                header("Location: jobboard.php");
                            }
                        }
                    $_SESSION['message']="You have accepted an employee for your job.";
                    header("Location: jobboard.php");
                    } else {
                        echo "Error fetching task count."; // Handle no count case
                    }
                    $countTask->close(); // Close the statement
                } else {
                    echo "Error executing count query: " . $countTask->error; // Handle query error
                }
            } else {
                echo "No task found or no pax value for this task."; // Handle no pax case
            }
        }
    }else{
        //Do nothing
    }
}
?>
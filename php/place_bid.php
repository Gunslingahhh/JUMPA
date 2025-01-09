<?php
session_start();
include "connection.php";

if (isset($_SESSION['user_id']) && isset($_POST['bidding_amount']) && isset($_GET['task_id'])) {
    $biddingAmount = floatval($_POST['bidding_amount']);
    $task_id = intval($_GET['task_id']);
    $user_id = intval($_SESSION['user_id']);

    // Check if a bid already exists for this user and task
    $searchStmt = $conn->prepare("SELECT bidding_id FROM bidding WHERE user_id = ? AND task_id = ?"); // Check by both
    if ($searchStmt === false) {
        die("Prepare search failed: " . $conn->error);
    }
    $searchStmt->bind_param("ii", $user_id, $task_id); // Bind user_id and task_id
    $searchStmt->execute();
    $searchResult = $searchStmt->get_result();

    if ($searchResult->num_rows > 0) {
        // Update existing bid
        $updateStmt = $conn->prepare("UPDATE bidding SET bidding_amount = ? WHERE user_id = ? AND task_id = ?");
        if ($updateStmt === false) {
            die("Prepare update failed: " . $conn->error);
        }
        $updateStmt->bind_param("dii", $biddingAmount, $user_id, $task_id); // Correct binding for update

        if ($updateStmt->execute()) {
            $_SESSION['message'] = "Your bid has been updated.";
        } else {
            $_SESSION['error'] = "Error updating your bid: " . $updateStmt->error;
        }
        $updateStmt->close();
    } else {
        // Insert new bid
        $insertStmt = $conn->prepare("INSERT INTO bidding (task_id, user_id, bidding_amount) VALUES (?, ?, ?)");
        if ($insertStmt === false) {
            die("Prepare insert failed: " . $conn->error);
        }

        $insertStmt->bind_param("iid", $task_id, $user_id, $biddingAmount);

        if ($insertStmt->execute()) {
            $_SESSION['message'] = "Bidding successful!";
        } else {
            $_SESSION['error'] = "Error placing bid: " . $insertStmt->error;
        }
        $insertStmt->close();
    }
    $searchStmt->close();
    header("Location: jobboard_detail.php?task_id=$task_id");
    exit();

} else {
    $_SESSION['error'] = "You must be logged in to bid.";
    header("Location: login.php");
    exit();
}
$conn->close(); // Close connection outside the main if
?>
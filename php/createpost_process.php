<?php
    session_start();

    include "connection.php";

    if (isset($_POST['createpost-submit'])) {
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
        $agerange = $_POST['agerange'];
        $muslimfriendly = $_POST['muslimfriendly'];
        $userid = $_SESSION['user_id'];

        $stmt = $conn->prepare("INSERT INTO task(
            task_title, 
            task_description, 
            task_date, 
            task_duration, 
            task_location, 
            task_toolsRequired, 
            task_pax, 
            task_price, 
            task_dressCode, 
            task_gender, 
            task_nationality, 
            task_ageRange, 
            task_muslimFriendly, 
            user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssiisssssi", 
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
                            $agerange, 
                            $muslimfriendly, 
                            $userid);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Task posted successfully!";
            header("Location: createpost.php");
            exit();
        } else {
            $_SESSION['error'] = "Error registering user: " . $stmt->error;
            header("Location: createpost.php");
            exit();
        }
    }
?>

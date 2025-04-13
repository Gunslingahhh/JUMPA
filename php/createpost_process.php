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
        $minAge = $_POST['minAge'];
        $maxAge = $_POST['maxAge'];
        $muslimfriendly = $_POST['muslimfriendly'];
        $foodProvision = $_POST['foodprovision'];
        $transportProvision = $_POST['transportprovision'];
        $userid = $_SESSION['user_id'];

        date_default_timezone_set('Asia/Kuching');
        $image_createdAt = date("dmYHis");
        $user_id = $_SESSION['user_id'];

        $stmt = $conn->prepare("INSERT INTO task(
            task_title, 
            task_description,
            task_photo,
            task_date, 
            task_duration,
            task_location,
            task_toolsRequired,
            task_pax,
            task_price,
            task_dressCode,
            task_gender,
            task_nationality, 
            task_minAge, 
            task_maxAge, 
            task_muslimFriendly, 
            task_foodProvision, 
            task_transportProvision, 
            user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Handle file upload
        $allowed_types = array('jpg', 'png', 'jpeg');
        if (empty($_FILES["task-photo"]["tmp_name"])) {
            $taskphoto = ""; // Set to default or handle as needed
        } else {
            $file_extension = strtolower(pathinfo($_FILES['task-photo']['name'], PATHINFO_EXTENSION));
            $newfilename = "taskPhoto_user_" . $user_id . "_" . $image_createdAt . "." . $file_extension;

            if (!in_array($file_extension, $allowed_types)) {
                $_SESSION['message'] = "Invalid file type. Only JPG and PNG are allowed.";
                header("Location: createpost.php");
                exit();
            } else {
                $target_dir = "../assets/uploads/task_photo/";
                $target_file = $target_dir . $newfilename;

                if (!move_uploaded_file($_FILES['task-photo']['tmp_name'], $target_file)) {
                    $_SESSION['message'] = "Error uploading file.";
                    error_log("File upload failed for: " . $_FILES['task-photo']['tmp_name']);
                    header("Location: createpost.php");
                    exit();
                } else {
                    $taskphoto = $target_file;
                    error_log("File uploaded successfully: " . $taskphoto);
                }
            }
        }


        $stmt->bind_param("sssssssiissssssiii",
                            $tasktitle, 
                            $taskdescription, 
                            $taskphoto,
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
                            $userid);

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
?>

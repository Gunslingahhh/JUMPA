<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['user_id'])) {
        echo "User ID is not set in session.";
    }
    else{
        date_default_timezone_set('Asia/Kuching');
        $image_createdAt = date("dmYHis");
        $user_id = $_SESSION['user_id'];

        $sql = "UPDATE user
                SET user_photo = ?
                WHERE user_id = ?";

        //Handle file upload
        $allowed_types = array('jpg', 'png', 'jpeg');

        if (($_FILES["user-photo-filename"]["tmp_name"]) == ""){
            $target_file = "";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
            $_SESSION['message'] = "Your profile picture has been updated.";
            header("Location: editprofile.php");
        }
        else{
            //Get file extension
            $file_extension = strtolower(pathinfo($_FILES['user-photo-filename']['name'], PATHINFO_EXTENSION));
            $newfilename = "profilePicture_user_" . $user_id . "." . $file_extension;
            
            if (!in_array($file_extension, $allowed_types)) {
                $_SESSION['message'] = "Invalid file type. Only JPG and PNG are allowed.";
                header("Location: editprofile.php");
            }
            else{
                //Set target directory and filename
                $target_dir = "../assets/uploads/profile_picture/";
                $target_file = $target_dir . $newfilename;

                if (!move_uploaded_file($_FILES['user-photo-filename']['tmp_name'], $target_file)){
                    $_SESSION['message'] = "Error uploading file.";
                    header("Location: editprofile.php");
                }
                else{
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $target_file, $user_id);
                    $stmt->execute();
                    $_SESSION['message'] = "Your profile picture has been updated.";
                    header("Location: editprofile.php");
                }
            }
        }
    }
    $stmt->close();
    $conn->close();
?>
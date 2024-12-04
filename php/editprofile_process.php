<?php
    session_start();
    include "connection.php";

    if (!isset($_SESSION['user_id'])) {
        echo "User ID is not set in session.";
    }
    else{
        $user_qualification=$_POST['user_qualification'];
        $user_certificate=$_POST['user_certificate'];
        $user_language=$_POST['user_language'];
        $user_workingExperienceWithJumpa=$_POST['user_workingExperienceWithJumpa'];
        $user_id=$_SESSION['user_id'];

        $sql = "UPDATE user
                SET user_qualification = ?, user_certificate = ?, user_language = ?, user_workingExperienceWithJumpa = ?
                WHERE user_id = ?";

        $data = array(
            $user_qualification,
            $user_certificate,
            $user_language,
            $user_workingExperienceWithJumpa,
            $user_id
        );

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", 
                            $user_qualification, 
                            $user_certificate, 
                            $user_language, 
                            $user_workingExperienceWithJumpa, 
                            $user_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Your information has been updated.";
            header("Location: editprofile.php");
            exit();
        } else {
            $_SESSION['message'] = "There's an error in updating your information";
            header("Location: editprofile.php");
            exit();
        }
    }
?>
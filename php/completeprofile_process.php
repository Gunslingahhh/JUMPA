<?php
    session_start();

    include "connection.php";

    if (isset($_SESSION['user_id'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $fullname = $_POST['fullname'];
        $gender = $_POST['gender'];
        $age = (int)$_POST['age'];
        $race = $_POST['race'];
        $religion = $_POST['religion'];
        $language = $_POST['language'];
        $icnumber = hash('sha256',$_POST['icnumber']);
        $contact = $_POST['contact'] ?? '';

        // Sanitize: Remove all non-digit characters
        $contact = preg_replace('/\D/', '', $contact);

        // If it starts with "0", remove it and prepend "+60"
        if (substr($contact, 0, 1) === '0') {
            $contact = '+60' . substr($contact, 1);
        } else {
            $contact = '+60' . $contact;
        }

        // Check if IC Number already exists
        $icCheckerStmt = $conn->prepare("SELECT user_ic FROM user WHERE user_ic = ?");
        $icCheckerStmt->bind_param("s", $icnumber);
        $icCheckerStmt->execute();
        $icCheckerResult = $icCheckerStmt->get_result();
        if ($icCheckerResult->num_rows > 0){
            $_SESSION['message'] = "This IC number is already registered.";
            header("Location: completeprofile.php");
        }
        else{
            $sql = "UPDATE user
                SET user_email = ?, user_ic = ?, user_fullname = ?, user_gender = ?, user_age = ?, user_contactNumber = ?, user_race = ?, user_religion = ?, user_language = ?
                WHERE user_id = ?";

            $data = array(
                $email,
                $icnumber,
                $fullname,
                $gender,
                $age,
                $contact,
                $race,
                $religion,
                $language,
                $_SESSION['user_id']
            );

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssissssi", ...$data);
            $stmt->execute();
            
            header("Location: home.php");
            exit();
        }
    }
    else{
        $_SESSION['message'] = "Session ID not declared.";
        header("Location: completeprofile.php");
    }
?>

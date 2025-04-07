<?php
// Start the session
session_start();

// Include database connection
include 'connection.php';

// Get the username and password from the form
$username = $_POST['username'];

// Check if the credentials are valid
$sql = "SELECT * FROM user WHERE BINARY user_username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Credentials are valid, fetch user_id and set session variables
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $user_ic = $row['user_ic'];
    $user_age = $row['user_age'];
    $salt = $row['user_salt'];
    $password = hash('sha256',$_POST['password'] . $salt);

    $credentialcheck = "SELECT * FROM user WHERE BINARY user_username=? AND user_password=?";
    $credentialstatement = $conn->prepare($credentialcheck);
    $credentialstatement->bind_param("ss", $username, $password);
    $credentialstatement->execute();
    $credentialresult = $credentialstatement->get_result();

    if ($credentialresult->num_rows >0){
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_age'] = $user_age;

        if ($user_ic == ""){
            // Redirect to the welcome page
            header("Location: completeprofile.php");
            exit();
        }
        else{
            header("Location: home.php");
            exit();
        }
        
    }
    else{
        $_SESSION['error'] = 'Incorrect username or password. Please try again.';
        header("Location: login.php");
        exit();
    }
} else {
    // Credentials are invalid, set an error message and redirect back to the login page
    $_SESSION['error'] = 'Incorrect username or password. Please try again.';
    header("Location: login.php");
    exit();
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>

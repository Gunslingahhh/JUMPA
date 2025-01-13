<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include "connection.php";

// Retrieve bidder ID from the URL
$bidding_id = filter_var($_GET['bidding_id'], FILTER_VALIDATE_INT);
$task_id = filter_var($_GET['task_id'], FILTER_VALIDATE_INT);
$user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);

//Task status from 0 to 1
$changeStatus = $conn->prepare("UPDATE task SET task_status='1' WHERE task_id = ?");
$changeStatus->bind_param("i",$task_id);

if($changeStatus->execute()){
    $acceptJob = $conn->prepare("INSERT INTO job(user_id, task_id, bidding_id) VALUES (?, ?, ?)");
    $acceptJob->bind_param("iii", $user_id, $task_id, $bidding_id);

    if ($acceptJob->execute()){
        $_SESSION['message'] = "Job accepted!";
        header("Location: jobboard.php");
        exit();
    }else{
        
    }
}else{

}

// Fetch bidder details
$sql = "
    SELECT 
        u.user_fullname, 
        u.user_photo, 
        u.user_contactNumber, 
        u.user_email, 
        u.user_gender, 
        u.user_age, 
        b.bidding_amount, 
        b.bidding_time 
    FROM user u
    INNER JOIN bidding b ON u.user_id = b.user_id
    WHERE b.bidding_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bidding_id) ;
$stmt->execute();
$result = $stmt->get_result();

$bidder = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidder Profile</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Include Top Navigation -->
    <?php include "topnav.php"; ?>

    <!-- Main Container -->
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Profile Card -->
                <div class="card text-center p-4 ">

                    <h4 class="mb-4">Employee Contact</h4>

                    <!-- Bidder Image -->
                    <img src="<?php echo htmlspecialchars($bidder['user_photo']); ?>" alt="Bidder Image" class="img-fluid rounded-circle mb-3 border-dark border-1" style="width: 150px; height: 150px; margin: 0 auto;">

                    <!-- Bidder Details -->
                    <h5><?php echo htmlspecialchars($bidder['user_fullname']); ?></h5>
                    <div class="d-flex justify-content-center mb-3">
                        <a href="https://wa.me/<?php echo htmlspecialchars($bidder['user_contactNumber']);?>" class="btn btn-success" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-whatsapp me-2"></i>Chat on WhatsApp
                        </a>
                    </div>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($bidder['user_email']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($bidder['user_gender']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($bidder['user_age']); ?></p>
                    <hr>
                    <p><strong>Bidding Amount:</strong> RM <?php echo htmlspecialchars($bidder['bidding_amount']); ?></p>
                    <p><strong>Bidding Time:</strong> <?php echo htmlspecialchars($bidder['bidding_time']); ?></p>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-danger">Report an Issue</button>
                        <button class="btn btn-success">Mark as Completed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
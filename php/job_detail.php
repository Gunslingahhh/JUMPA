<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include "connection.php";

$userName=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php
        include "topnav.php";

        $id = $_GET['task_id'];
        $user_id = $_SESSION['user_id'];

        $detail_check = $conn->prepare("SELECT * FROM task t
                                        INNER JOIN job j ON t.task_id = j.task_id
                                        INNER JOIN user u ON u.user_id = j.user_id
                                        INNER JOIN bidding b on b.bidding_id = j.bidding_id
                                        WHERE t.task_status = '1' AND t.user_id = ?;");
        
        $detail_check->bind_param("i", $user_id);
        $detail_check->execute();
        $detail_result = $detail_check->get_result();

        while ($user_row = $detail_result->fetch_assoc()) {
        echo "
            <div class='employee-dashboard pb-0'>            
                <div class='container'>
                    <h4 class='mb-4 text-center'>Job Details</h4>
                    <div class='row full-height'>
                        <div class='col-12 mb-4'>
                            <div class='container task-details-card'>
                                <h5 class='mb-4'>Employee Details</h5>
                                <div class='row details-p'>
                                    <div class='col-lg-3 col-md-6 col-sm-12'>
                                        <img src='{$user_row['user_photo']}' id='modal-photo' class='rounded-circle mb-2'>
                                        <p><strong>Name: </strong> " . htmlspecialchars($user_row['user_fullname']) . "</p>
                                        <p><strong>Contact Number: </strong> " . htmlspecialchars($user_row['user_contactNumber']) . "</p>
                                        <p><strong>E-mail: </strong> " . htmlspecialchars($user_row['user_email']) . "</p>
                                        <p><strong>Gender: </strong> " . htmlspecialchars($user_row['user_gender']) . "</p>
                                        <p><strong>Age: </strong> " . htmlspecialchars($user_row['user_age']) . "</p>
                                        <p><strong>Bidding amount: RM </strong> " . htmlspecialchars($user_row['bidding_amount']) . "</p>
                                        <p><strong>Bidding time: </strong> " . htmlspecialchars($user_row['bidding_time']) . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='employee-dashboard pt-0'>            
                <div class='container'>
                    <div class='row full-height'>
                        <div class='col-12 mb-4'>
                            <div class='container task-details-card'>
                                <h5 class='mb-4'>Task Details</h5>
                                <div class='row details-p'>
                                    <div class='col-lg-3 col-md-6 col-sm-12'>
                                        <p><strong>Title:</strong> " . htmlspecialchars($user_row['task_title']) . "</p>
                                        <p><strong>Description:</strong> " . htmlspecialchars($user_row['task_description']) . "</p>
                                        <p><strong>Date:</strong> " . htmlspecialchars($user_row['task_date']) . "</p>
                                        <p><strong>Duration:</strong> " . htmlspecialchars($user_row['task_duration']) . "</p>
                                        <p><strong>Location:</strong> " . htmlspecialchars($user_row['task_location']) . "</p>
                                        <p><strong>Tools Required:</strong> " . htmlspecialchars($user_row['task_toolsRequired']) . "</p>
                                        <p><strong>Pax:</strong> " . htmlspecialchars($user_row['task_pax']) . "</p>
                                        <p><strong>Price:</strong> " . htmlspecialchars($user_row['task_price']) . "</p>
                                        <p><strong>Dress Code:</strong> " . htmlspecialchars($user_row['task_dressCode']) . "</p>
                                        <p><strong>Gender:</strong> " . htmlspecialchars($user_row['task_gender']) . "</p>
                                        <p><strong>Nationality:</strong> " . htmlspecialchars($user_row['task_nationality']) . "</p>
                                        <p><strong>Age Range:</strong> " . htmlspecialchars($user_row['task_ageRange']) . "</p>
                                        <p><strong>Muslim Friendly:</strong> " . htmlspecialchars($user_row['task_muslimFriendly']) . "</p>
                                        <p><strong>Food Provision:</strong> " . htmlspecialchars($user_row['task_foodProvision']) . "</p>
                                        <p><strong>Transport Provision:</strong> " . htmlspecialchars($user_row['task_transportProvision']) . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>";
        }
    ?>
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

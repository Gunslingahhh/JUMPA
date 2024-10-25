<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Retrieve bidder details from the URL parameters
$bidder_name = isset($_GET['name']) ? $_GET['name'] : 'Unknown';
$bid_amount = isset($_GET['bid']) ? $_GET['bid'] : 'Unknown';
$bidder_image = isset($_GET['img']) ? $_GET['img'] : '../assets/images/default-profile.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidder Profile</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <div class="bidder-profile-card text-center p-4">
                    <h4 class="mb-4">Employee Contact</h4>

                    <!-- Bidder Image and Contact -->
                    <img src="<?php echo $bidder_image; ?>" alt="Bidder Image" class="mb-3">
                    <h5><?php echo $bidder_name; ?></h5>

                    <!-- Task Info -->
                    <div class="mb-4 text-start">
                        <p><strong>Task title:</strong> Fix door</p>
                        <p><strong>Task date/time:</strong> 24/05 08:00</p>
                        <p><strong>Price:</strong> RM50</p>
                    </div>

                    <!-- Contact Number -->
                    <p class="mb-4">
                    <i class="fa fa-whatsapp" style="font-size:24px;color:green"></i>
                        +60818181811
                    </p>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-red">Report an issue</button>
                        <button class="btn btn-red">Job done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome for WhatsApp icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

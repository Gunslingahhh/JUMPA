<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- Standard Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

    <!-- PNG Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">

    <!-- Apple Touch Icon (for iPhones/iPads) -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">

    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="../assets/favicon/android-chrome-512x512.png">
    
</head>

<body>
    <?php
    include "topnav.php";
    ?>
    <!-- Main Content -->
    <main>
        <!-- Main Banner -->
        <div class="main-banner">
            <p class="main-banner-header-p">The best gig platform for all, a quick way to hire helpers and perform tasks
            </p>
            <img src="../assets/images/jumpa-logo-with-word.png" alt="jumpa-xxl-logo" class="jumpa-xxl-logo" />
            <p class="simple-quick-secure">Simple . Quick . Secure.</p>
        </div>

        <!-- Hire Section -->
        <section class="hire-skilled-worker">
            <div class="hire-skilled-worker-text">
                <h2 class="hire-h2">Hire a skilled worker</h2>
                <p>Whatever task you need!</p>
                <p>Our gig platform is designed to help connecting people together to get a task done. We make hiring
                    the right person for your needs quick, easy, and safe.</p>
                <a href="employeedashboard.php" class="hire-button">Learn more</a>
            </div>

            <div class="hire-skilled-worker-images">
                <img src="../assets/images/undraw_hire_re_gn5j.svg" alt="image-1">
                <!-- <img src="../assets/images/icons8-clock-50.png" alt="image-2"> -->
            </div>
        </section>

        <!-- 'Do Work, Get Paid' Section-->
        <section class="do-work-get-paid">
            <div class="do-work-get-paid-images">
                <img src="../assets/images/undraw_at_work_re_qotl.svg" alt="image-1">
                <!-- <img src="" alt="image-2"> -->
            </div>

            <div class="do-work-get-paid-text">
                <h2 class="work-get-paid-h2">Do work, get paid</h2>
                <p>Earn up to Rm500 per day</p>
                <p>Choose between a variety of gigs available and earn cash per job</p>
                <a href="employeedashboard.php" class="work-pay-button">Learn more</a>
            </div>
        </section>

        <!-- Safety Section -->
        <section class="security">
            <div class="security-text">
                <h2 class="safety-h2">Stay safe</h2>
                <p>Secure Payment Processing</p>
                <p>Earn as you want, confidently, with secure transactions every time.</p>
            </div>

            <div class="security-images">
                <img src="../assets/images/undraw_two_factor_authentication_namy.svg" alt="image-1">
            </div>
        </section>

        <!-- Verification Section -->
        <section class="verification">
            <div class="verification-images">
                <img src="../assets/images/undraw_security_on_re_e491.svg" alt="image-1">
            </div>

            <div class="verification-text">
                <h2 class="verify-h2">Verification</h2>
                <p>Get verified gig workers</p>
                <p>Trust that highly rated workers have been evaluated for their skills and are highly recommended to
                    employers.</p>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
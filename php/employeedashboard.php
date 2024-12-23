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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php
        include "topnav.php";
    ?>

    <!-- Main Content -->
    <main>
        <div class="employee-dashboard">

            <!-- Recommended Gigs -->
            <h4 class="mt-3 mb-4 text-center">Recommended Gigs</h4>
            <div class="row gig-row">
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <p class="time-posted">Posted 2 weeks ago</p>
                    <h3 class="recommended-gig-title">Cut my house grass</h3>
                    <img src="../assets/images/cut-grass.jpeg" alt="Cut grass" class="gig-card-img">
                    <div class="time">
                        <p class="gig-time"><img src="../assets/images/time.png" alt="Time" class="gig-img" /> 1300 - 1600</p>
                    </div>
                    <div class="location">
                        <p class="gig-location"><img src="../assets/images/location.png" alt="location" class="gig-img"> Bangsar, KL</p>
                    </div>
                    <div class="price">
                        <p class="gig-price"><img src="../assets/images/price.png" alt="price" class="gig-img" /> RM90</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <p class="time-posted">Posted 2 weeks ago</p>
                    <h3 class="recommended-gig-title">Wash clothes</h3>
                    <img src="../assets/images/laundry.jpeg" alt="Washing clothes" class="gig-card-img">
                    <div class="time">
                        <p class="gig-time"><img src="../assets/images/time.png" alt="Time" class="gig-img" /> 1600 - 1700</p>
                    </div>
                    <div class="location">
                        <p class="gig-location"><img src="../assets/images/location.png" alt="location" class="gig-img"> Seri Kembangan, KL</p>
                    </div>
                    <div class="price">
                        <p class="gig-price"><img src="../assets/images/price.png" alt="price" class="gig-img" /> RM50</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <p class="time-posted">Posted Yesterday</p>
                    <h3 class="recommended-gig-title">Market helper</h3>
                    <img src="../assets/images/market.jpeg" alt="Market helper" class="gig-card-img">
                    <div class="time">
                        <p class="gig-time"><img src="../assets/images/time.png" alt="Time" class="gig-img" /> 0700 - 0900</p>
                    </div>
                    <div class="location">
                        <p class="gig-location"><img src="../assets/images/location.png" alt="location" class="gig-img"> Kajang, Selangor</p>
                    </div>
                    <div class="price">
                        <p class="gig-price"><img src="../assets/images/price.png" alt="price" class="gig-img" /> RM30</p>
                    </div>
                </div>
            </div>

            <!-- Recent Gigs -->
            <h2 class="section-title mt-3">Your Recent Gigs</h2>
            <div class="row gig-row">
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <h3 class="recent-gig-title">None</h3>
                    <img src="../assets/images/bidding.png" alt="Bid for jobs now!">
                    <p>Bid for jobs now!</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <h3></h3>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 gig-card">
                    <h3></h3>
                </div>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

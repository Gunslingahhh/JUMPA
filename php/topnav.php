<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css?v=1">
</head>
<body>
    <header class="py-2 px-5 border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="home.php">
                    <img src="../assets/images/jumpa-logo.png" alt="Jumpa Logo" class="jumpa-logo"/>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Horizontal Navigation -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0  horizontal-nav">
                        <li class="nav-item"><a class="nav-link" href="employeedashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="createpost.php">Create Post</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Messages</a>
                            <ul class="dropdown-menu" aria-labelledby="messagesDropdown">
                                <li><a class="dropdown-item" href="#">Inbox</a></li>
                                <li><a class="dropdown-item" href="#">Notifications</a></li>
                            </ul>
                        </li> -->
                        <li class="nav-item"><a class="nav-link" href="jobboard.php">Job Board</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="paymentsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Payments</a>
                            <ul class="dropdown-menu" aria-labelledby="paymentsDropdown">
                                <li><a class="dropdown-item" href="#">Billing Information</a></li>
                                <li><a class="dropdown-item" href="#">View Balance</a></li>
                                <li><a class="dropdown-item" href="#">Transaction History</a></li>
                                <li><a class="dropdown-item" href="#">Payment Methods</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <!-- Search Bar -->
                    <form class="d-flex nav-search-bar">
                        <input type="text" class="form-control me-2" name="search-bar" id="nav-search" placeholder="How can we help?">
                    </form>
                    <!-- Notifications, Messages, User Info -->
                    <div class="d-flex align-items-center gap-3">
                        <img src="../assets/images/icons8-bell.png" alt="Notifications Icon" width="32" class="notifications-img">
                        <img src="../assets/images/icons8-messages.png" alt="Messages Icon" width="32" class="messages-img">
                        <div class="nav-item dropdown profile-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['username'];?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="home.php">Home</a></li>
                                <li><a class="dropdown-item" href="editprofile.php">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Categories Navigation -->
    <div class="categories-container px-3 py-1 border-bottom">
        <div class="categories d-inline">
            <a href="#" class="text-dark m-1">Home Repair & Maintenance</a>
            <a href="#" class="text-dark m-1">Cleaning Services</a>
            <a href="#" class="text-dark m-1">Delivery & Errands</a>
            <a href="#" class="text-dark m-1">Landscaping & Gardening</a>
            <a href="#" class="text-dark m-1">Handyman Services</a>
            <a href="#" class="text-dark m-1">Moving & Packing</a>
            <a href="#" class="text-dark m-1">Furniture Assembly</a>
            <a href="#" class="text-dark m-1">Plumbing & Electrical</a>
            <a href="#" class="text-dark m-1">Painting & Decorating</a>
            <a href="#" class="text-dark m-1">Pet Care & Dog Walking</a>
            <a href="#" class="text-dark m-1">Event Planning & Staffing</a>
            <a href="#" class="text-dark m-1">Photography & Videography</a>
            <a href="#" class="text-dark m-1">House Sitting & Caretaking</a>
            <a href="#" class="text-dark m-1">Tutoring & Lessons</a>
            <a href="#" class="text-dark m-1">Fitness Training & Coaching</a>
            <a href="#" class="text-dark m-1">Hair & Beauty Services</a>
            <a href="#" class="text-dark m-1">Car Repair & Maintenance</a>
            <a href="#" class="text-dark m-1">IT Support & Tech Help</a>
            <a href="#" class="text-dark m-1">Graphic Design & Branding</a>
            <a href="#" class="text-dark m-1">Web & App Development</a>
            <a href="#" class="text-dark m-1">Content Writing & Copywriting</a>
            <a href="#" class="text-dark m-1">Social Media Management</a>
            <a href="#" class="text-dark m-1">Marketing & Sales Support</a>
            <a href="#" class="text-dark m-1">Virtual Assistance & Admin</a>
            <a href="#" class="text-dark m-1">Translation & Interpretation</a>
            <a href="#" class="text-dark m-1">Business Consulting</a>
            <a href="#" class="text-dark m-1">Real Estate Assistance</a>
            <a href="#" class="text-dark m-1">Event & Party Rentals</a>
            <a href="#" class="text-dark m-1">Interior Design & Home Staging</a>
            <a href="#" class="text-dark m-1">Childcare & Babysitting</a>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
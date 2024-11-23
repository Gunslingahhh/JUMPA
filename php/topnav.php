<iv?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styles.css?v=1">
    </head>
    <body>
        <header class="py-2 border-bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-evenly nav-content mx-5 py-2">
                    <!-- Logo -->
                    <div class="col-auto">
                        <a href="home.php">
                            <div class="logo">
                                <img src="../assets/images/jumpa-logo.png" alt="Jumpa Logo" class="jumpa-logo" />
                            </div>
                        </a>
                    </div>

                    <!-- Horizontal Navigation -->
                    <div class="col-md col-sm-12 d-flex align-items-center justify-content-start sub-navbar">
                        <a href="employeedashboard.php">Dashboard</a>
                        <a href="createpost.php">Create Post</a>
                        <div class="dropdown d-inline">
                            <a href="#" class="dropdown-toggle no-arrow" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Messages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="messagesDropdown">
                                <li><a class="dropdown-item" href="#">Inbox</a></li>
                                <li><a class="dropdown-item" href="#">Notifications</a></li>
                            </ul>
                        </div>
                        <a href="old_jobboard.php">Job Board</a>
                        <!-- Payments Dropdown -->
                        <div class="dropdown d-inline">
                            <a href="#" class="dropdown-toggle no-arrow" id="paymentsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Payments
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="paymentsDropdown">
                                <li><a class="dropdown-item" href="#">Billing Information</a></li>
                                <li><a class="dropdown-item" href="#">View Balance</a></li>
                                <li><a class="dropdown-item" href="#">Transaction History</a></li>
                                <li><a class="dropdown-item" href="#">Payment Methods</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="col-md-4 col-sm-6 d-flex align-items-center justify-content-center pr-1">
                        <div class="nav-search-bar">
                            <input type="text" class="form-control" name="nav-search-bar" id="nav-search" placeholder="How can we help?">
                        </div>
                    </div>
                    
                    <!-- Notifications, Messages, User Info -->
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">
                            <div class="nav-notifications">
                                <img src="../assets/images/icons8-bell.png" alt="Notifications Icon" width="32">
                            </div>
                            <div class="nav-messages">
                                <img src="../assets/images/icons8-messages.png" alt="Messages Icon" width="32">
                            </div>

                            <div class="navbar mr-4 px-2">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['username'];?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item logout-link text-dark dropdown-profile" href="home.php">Home</a><hr class="dropdown-divider">
                                        <li><a class="dropdown-item username-nav text-dark dropdown-profile" href="editprofile.php">Profile</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item logout-link text-dark dropdown-profile" href="logout.php">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Categories Navigation -->
        <div class="categories-container mt-2 mb-3 px-3 py-1 border-bottom">
            <div class="categories d-flex justify-content-center">
                <a href="#" class="text-dark">Home Repair & Maintenance</a>
                <a href="#" class="text-dark">Cleaning Services</a>
                <a href="#" class="text-dark">Delivery & Errands</a>
                <a href="#" class="text-dark">Landscaping & Gardening</a>
                <a href="#" class="text-dark">Handyman Services</a>
                <a href="#" class="text-dark">Moving & Packing</a>
                <a href="#" class="text-dark">Furniture Assembly</a>
                <a href="#" class="text-dark">Plumbing & Electrical</a>
                <a href="#" class="text-dark">Painting & Decorating</a>
                <a href="#" class="text-dark">Pet Care & Dog Walking</a>
                <a href="#" class="text-dark">Event Planning & Staffing</a>
                <a href="#" class="text-dark">Photography & Videography</a>
                <a href="#" class="text-dark">House Sitting & Caretaking</a>
                <a href="#" class="text-dark">Tutoring & Lessons</a>
                <a href="#" class="text-dark">Fitness Training & Coaching</a>
                <a href="#" class="text-dark">Hair & Beauty Services</a>
                <a href="#" class="text-dark">Car Repair & Maintenance</a>
                <a href="#" class="text-dark">IT Support & Tech Help</a>
                <a href="#" class="text-dark">Graphic Design & Branding</a>
                <a href="#" class="text-dark">Web & App Development</a>
                <a href="#" class="text-dark">Content Writing & Copywriting</a>
                <a href="#" class="text-dark">Social Media Management</a>
                <a href="#" class="text-dark">Marketing & Sales Support</a>
                <a href="#" class="text-dark">Virtual Assistance & Admin</a>
                <a href="#" class="text-dark">Translation & Interpretation</a>
                <a href="#" class="text-dark">Business Consulting</a>
                <a href="#" class="text-dark">Real Estate Assistance</a>
                <a href="#" class="text-dark">Event & Party Rentals</a>
                <a href="#" class="text-dark">Interior Design & Home Staging</a>
                <a href="#" class="text-dark">Childcare & Babysitting</a>
            </div>
        </div>

        <script src="../assets/js/app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
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
                        <div class="logo">
                            <img src="../assets/images/jumpa-logo.png" alt="Jumpa Logo" class="jumpa-logo" />
                        </div>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="col-md col-sm-12 d-flex align-items-center justify-content-end pr-1">
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

                            <div class="navbar mr-3 px-2 nav-bar-dropdown">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle no-arrow" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['username'];?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item logout-link text-dark dropdown-profile" href="home.php">Home</a><hr class="dropdown-divider">
                                        <li><a class="dropdown-item username-nav text-dark dropdown-profile" href="createprofile.php">Profile</a></li>
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

        <main>
            <section class="createprofilemain">
                <h1 class="createprofiletitle">
                    Create Your Employee Profile
                </h1>
                <div class="profile-form mt-3 mx-auto">
                    <form id="profileForm" action="createprofile_process.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" pattern="[0-9]{10}" required>
                        </div>

                        <div class="mb-3">
                            <label for="race" class="form-label">Race</label>
                            <input type="text" class="form-control" id="race" required>
                        </div>

                        <div class="mb-3">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="religion" required>
                        </div>

                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <input type="text" class="form-control" id="language" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <?php
                        if (isset($_SESSION['message'])) {
                            echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                            unset($_SESSION['message']);
                        }
                    ?>
                </div>

            </section>
        </main>

        <script src="../assets/js/app.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
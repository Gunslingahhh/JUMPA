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
                        <a href="home.php">
                            <div class="logo">
                                <img src="../assets/images/jumpa-logo.png" alt="Jumpa Logo" class="jumpa-logo" />
                            </div>
                        </a>
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

        <main id="profilemainid">
            <section class="createprofilemain">
                <?php
                        if (isset($_SESSION['message'])) {
                            echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                            unset($_SESSION['message']);
                        }
                    ?>
                <div class="profile-form mt-3 mx-auto">
                    <form id="profileForm" action="createpost_process.php" method="post">
                        <h1 class="createprofiletitle">
                            Post a Task
                        </h1>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Task title</label>
                            <input type="text" class="form-control" name="tasktitle" id="tasktitle" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Task Description</label>
                            <input type="text" class="form-control" name="taskdescription" id="taskdescription" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Task Date</label>
                            <input type="date" class="form-control" name="taskdate" id="taskdate" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Task Duration</label>
                            <input type="text" class="form-control" name="taskduration" id="taskduration" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Task Location</label>
                            <input type="text" class="form-control" name="tasklocation" id="tasklocation" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Tools required</label>
                            <input type="text" class="form-control" name="toolsrequired" id="toolsrequired" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Pax</label>
                            <input type="number" class="form-control" name="pax" id="pax" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required>
                        </div>
                        <h1 class="createprofiletitle">
                            Additional Information
                        </h1>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Dress Code</label>
                            <input type="text" class="form-control" name="dresscode" id="dresscode" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Gender</label>
                            <input type="text" class="form-control" name="gender" id="gender" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Age Range</label>
                            <input type="text" class="form-control" name="agerange" id="agerange" required>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Muslim friendly?</label>
                            <input type="radio" class="form-check-input" name="muslimfriendly" value="Yes" id="muslimfriendly1" required>
                            <label class="form-check-label" for="muslimfriendly1">
                                Yes
                            </label>
                            <input type="radio" class="form-check-input" name="muslimfriendly" value="No" id="muslimfriendly2" required>
                            <label class="form-check-label" for="muslimfriendly2">
                                No
                            </label>
                        </div>
                        <button type="submit" name="createpost-submit" class="btn btn-primary">Submit</button>
                    </form>
                
                    
                </div>

            </section>
        </main>

        <script src="../assets/js/app.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

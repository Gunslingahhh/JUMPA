<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: index.php");
        exit();
    }

    include "connection.php";

    $user_id=$_SESSION['user_id'];
    $sql = "SELECT user_username, user_email, user_fullname, user_gender, user_age, user_contactNumber, user_photo, user_qualification, user_certificate, user_race, user_religion, user_language, user_workingExperienceWithJumpa FROM user WHERE user_id = $user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $user_username = $row['user_username'];
    $user_email = $row['user_email'];
    $user_fullname = $row['user_fullname'];
    $user_gender = $row['user_gender'];
    $user_age = $row['user_age'];
    $user_contactNumber = $row['user_contactNumber'];
    $user_photo = $row['user_photo'];
    $user_qualification = $row['user_qualification'];
    $user_certificate = $row['user_certificate'];
    $user_race = $row['user_race'];
    $user_religion = $row['user_religion'];
    $user_language = $row['user_language'];
    $user_workingExperienceWithJumpa = $row['user_workingExperienceWithJumpa'];
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

        <main id="profilemainid">
            <section class="createprofilemain">
                <h1 class="createprofiletitle">Edit Your Profile</h1>
                <img id="profile-picture" src="<?php echo $user_photo; ?>"><br>
                <p>Username: <?php echo $user_username; ?></p>
                <p>Email: <?php echo $user_email; ?></p>
                <p>Fullname: <?php echo $user_fullname; ?></p>
                <p>Gender: <?php echo $user_gender; ?></p>
                <p>Age: <?php echo $user_age; ?></p>
                <p>ContactNumber: <?php echo $user_contactNumber; ?></p>
                <p>Photo: <?php echo $user_photo; ?></p>
                <p>Qualification: <?php echo $user_qualification; ?></p>
                <p>Certificate: <?php echo $user_certificate; ?></p>
                <p>Race: <?php echo $user_race; ?></p>
                <p>Religion: <?php echo $user_religion; ?></p>
                <p>Language: <?php echo $user_language; ?></p>
                <p>WorkingExperienceWithJumpa: <?php echo $user_workingExperienceWithJumpa; ?></p>
            </section>
        </main>

        <script src="../assets/js/app.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
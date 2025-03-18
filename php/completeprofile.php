<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>

<body>
    <?php include 'topnav.php'; ?>
    <main id="profilemainid">
        <section class="createprofilemain">
            <h1 class="createprofiletitle">
                Complete Your Profile
            </h1>
            <div class="profile-form mt-3 mx-auto">
                <form id="profileForm" action="completeprofile_process.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">IC / Passport Number</label>
                        <input type="text" class="form-control" id="icnumber" name="icnumber"
                            aria-describedby="emailHelp" required>
                        <div id="icHelp" class="form-text">Your identity number will be used for admin users only in
                            case of criminal activity. This data will be protected by the rights of PDPA Act 2010.</div>
                    </div>

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="" disabled selected>Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="age" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="contact" name="contact" pattern="[0-9]{10}" required>
                    </div>

                    <div class="mb-3">
                        <label for="race" class="form-label">Race</label>
                        <input type="text" class="form-control" id="race" name="race" required>
                    </div>

                    <div class="mb-3">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" required>
                    </div>

                    <div class="mb-3">
                        <label for="language" class="form-label">Language</label>
                        <input type="text" class="form-control" id="language" name="language" required>
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
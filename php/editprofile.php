<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
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
        <?php include 'topnav.php' ?>

        <main id="profilemainid">
            <h4 class="mt-3 mb-4 text-center">Edit Your Profile</h4>
            <section class="createprofilemain">
                <?php
                    if (isset($_SESSION['message'])) {
                        echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                <form action="userphoto_process.php" method="POST" enctype="multipart/form-data" class="upload-form">    
                    <img id="user-photo" role="button" width="120px" height="120px" src="<?php echo $user_photo; ?>">
                    <input type="file" id="user-photo-filename" name="user-photo-filename" accept="image/jpeg, image/png, image/jpg" style="display: none;">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                <form action="editprofile_process.php" method="POST" class="editprofile-form">
                    <div class="editprofile-row">
                        <label for="user_username">Username:</label>
                        <input id="user_username" name="user_username" type="text" class="form-control" value="<?php echo $user_username; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_email">Email:</label>
                        <input id="user_email" name="user_email" type="text" class="form-control" value="<?php echo $user_email; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_fullname">Fullname:</label>
                        <input id="user_fullname" name="user_fullname" type="text" class="form-control" value="<?php echo $user_fullname; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_gender">Gender:</label>
                        <input id="user_gender" name="user_gender" type="text" class="form-control" value="<?php echo $user_gender; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_age">Age:</label>
                        <input id="user_age" name="user_age" type="number" class="form-control" value="<?php echo $user_age; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_contactNumber">Contact Number:</label>
                        <input id="user_contactNumber" name="user_contactNumber" type="text" class="form-control" value="<?php echo $user_contactNumber; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_photo">Photo:</label>
                        <input id="user_photo" name="user_photo" type="text" class="form-control" value="<?php echo $user_photo; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_qualification">Qualification:</label>
                        <input id="user_qualification" name="user_qualification" type="text" class="form-control" value="<?php echo $user_qualification; ?>">
                    </div>
                    <div class="editprofile-row">
                        <label for="user_certificate">Certificate:</label>
                        <input id="user_certificate" name="user_certificate" type="text" class="form-control" value="<?php echo $user_certificate; ?>">
                    </div>
                    <div class="editprofile-row">
                        <label for="user_race">Race:</label>
                        <input id="user_race" name="user_race" type="text" class="form-control" value="<?php echo $user_race; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_religion">Religion:</label>
                        <input id="user_religion" name="user_religion" type="text" class="form-control" value="<?php echo $user_religion; ?>" disabled>
                    </div>
                    <div class="editprofile-row">
                        <label for="user_language">Language:</label>
                        <input id="user_language" name="user_language" type="text" class="form-control" value="<?php echo $user_language; ?>">
                    </div>
                    <div class="editprofile-row">
                        <label for="user_workingExperienceWithJumpa">Working Experience With Jumpa:</label>
                        <input id="user_workingExperienceWithJumpa" name="user_workingExperienceWithJumpa" type="text" class="form-control" value="<?php echo $user_workingExperienceWithJumpa; ?>">
                    </div>
                    <div class="editprofile-submit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </section>
        </main>

        <script src="../assets/js/app.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include "connection.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT user_username, user_email, user_fullname, user_gender, user_age, user_contactNumber, user_photo, user_qualification, user_certificate, user_race, user_religion, user_language, user_workingExperienceWithJumpa FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$user_photo = !empty($row['user_photo']) ? $row['user_photo'] : '../assets/images/default-profile.png';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css?v=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'topnav.php'; ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="profileUpdateToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php if (isset($_SESSION['message'])) { 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']); // Clear session message after displaying
                } ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <main class="container mt-4 w-75">
        <h4 class="text-center mb-3">Edit Your Profile</h4>

        <div class="mx-auto p-4 shadow-sm">
            <!-- Profile Picture Upload -->
            <div class="d-flex justify-content-end align-items-center gap-1 p-1 w-75">
                <div class="text-center d-flex align-items-end p-1">
                    <p class="profile-text fw-bold w-75">Edit Picture <span class="fst-italic fw-light fs-0"
                            style="font-size: 0.75em;">Click on
                            the
                            picture
                            to
                            edit: </span> </p>
                </div>
                <div class="profile-photo-form">
                    <form action="userphoto_process.php" method="POST" enctype="multipart/form-data"
                        class="text-center d-flex justify-content-center align-items-center gap-4 p-1">
                        <div class="my-1">
                            <img id="user-photo" class="rounded-circle border border-secondary" width="120" height="120"
                                src="<?= $user_photo ?>" role="button">
                        </div>
                        <input type="file" id="user-photo-filename" name="user-photo-filename"
                            accept="image/jpeg, image/png, image/jpg" hidden>
                        <button type="submit" class="btn btn-primary" id="upload-button" disabled>Upload</button>
                    </form>
                </div>
            </div>

            <hr>

            <!-- Profile Edit Form -->
            <form action="editprofile_process.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" class="form-control" value="<?= $row['user_username'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="text" class="form-control" value="<?= $row['user_email'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fullname:</label>
                    <input type="text" class="form-control" value="<?= $row['user_fullname'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender:</label>
                    <input type="text" class="form-control" value="<?= $row['user_gender'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age:</label>
                    <input type="number" class="form-control" value="<?= $row['user_age'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contact Number:</label>
                    <input type="text" class="form-control" value="<?= $row['user_contactNumber'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Qualification:</label>
                    <input type="text" class="form-control" name="user_qualification"
                        value="<?= $row['user_qualification'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Certificate:</label>
                    <input type="text" class="form-control" name="user_certificate"
                        value="<?= $row['user_certificate'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Language:</label>
                    <input type="text" class="form-control" name="user_language" value="<?= $row['user_language'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Working Experience With Jumpa:</label>
                    <input type="text" class="form-control" name="user_workingExperienceWithJumpa"
                        value="<?= $row['user_workingExperienceWithJumpa'] ?>">
                </div>
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <button type="submit" class="btn btn-success w-25">Submit</button>
                </div>
            </form>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById("user-photo-filename");
        const uploadButton = document.getElementById("upload-button");
        const profilePicture = document.getElementById("user-photo");
        const formInputs = document.querySelectorAll("form input:not([disabled])");
        const submitButton = document.querySelector("button[type='submit']");

        uploadButton.disabled = true; // Ensure it's disabled on page load
        submitButton.disabled = true; // Disable submit button initially

        // Enable the file input when clicking on the image
        profilePicture.addEventListener("click", function() {
            fileInput.click();
        });

        // Handle profile picture change
        fileInput.addEventListener("change", function(event) {
            const file = event.target.files[0];

            if (!file || !file.type.match("image.*")) {
                alert("Please select a valid image file.");
                uploadButton.disabled = true;
                return;
            }

            // Show preview before uploading
            const reader = new FileReader();
            reader.onload = function(e) {
                profilePicture.src = e.target.result;
            };
            reader.readAsDataURL(file);

            uploadButton.disabled = false; // Enable button when a file is selected
        });

        // Enable the submit button if any form field is changed
        formInputs.forEach(input => {
            input.addEventListener("input", function() {
                submitButton.disabled = false;
            });
        });

        // Show the toast for 3 seconds
        const toastEl = document.getElementById('profileUpdateToast');
        if (toastEl && toastEl.querySelector('.toast-body').textContent.trim() !== '') {
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: 3000 // 3 seconds
            });
            toast.show();
        }
    });
    </script>

</body>

</html>
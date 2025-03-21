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
    <?php
    include 'topnav.php'
    ?>

    <main id="profilemainid">
        <h4 class="mt-3 mb-4 text-center">Post a Task</h4>
        <section class="container mt-4 w-75 bg-white rounded">
            <?php
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
            }
            ?>
            <div class="profile-form mt-3">
                <form id="profileForm" action="createpost_process.php" method="post" enctype="multipart/form-data"
                    class="createpost-form">
                    <div class="form-row">
                        <label for="tasktitle" class="form-label">Task Title</label>
                        <input type="text" class="form-control" name="tasktitle" id="tasktitle" required>
                    </div>

                    <div class="form-row">
                        <label for="taskdescription" class="form-label">Task Description</label>
                        <textarea class="form-control" name="taskdescription" id="taskdescription" rows="4"
                            required></textarea>
                    </div>

                    <div class="form-row">
                        <label for="taskphoto" class="form-label">Task Photo</label>
                        <img id="task-photo-container" class="p-0 form-control" role="button">
                        <input type="file" id="task-photo" name="task-photo" accept="image/jpeg, image/png, image/jpg"
                            style="display: none;">
                    </div>

                    <div class="form-row">
                        <label for="taskdate" class="form-label">Task Date</label>
                        <input type="date" class="form-control" name="taskdate" id="taskdate" required>
                    </div>

                    <div class="form-row">
                        <label for="taskduration" class="form-label">Task Duration</label>
                        <input type="text" class="form-control" name="taskduration" id="taskduration" placeholder="hrs" required>
                    </div>

                    <div class="form-row">
                        <label for="tasklocation" class="form-label">Task Location</label>
                        <input type="text" class="form-control" name="tasklocation" id="tasklocation" required>
                    </div>

                    <div class="form-row">
                        <label for="toolsrequired" class="form-label">Tools Required</label>
                        <input type="text" class="form-control" name="toolsrequired" id="toolsrequired" required>
                    </div>

                    <div class="form-row">
                        <label for="pax" class="form-label">Pax</label>
                        <input type="number" class="form-control" name="pax" id="pax" required>
                    </div>

                    <div class="form-row">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>

                    <p class="additional-info">Additional Information</p>

                    <div class="form-row">
                        <label for="dresscode" class="form-label">Dress Code</label>
                        <input type="text" class="form-control" name="dresscode" id="dresscode" required>
                    </div>

                    <div class="form-row">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="nationality" class="form-label">Nationality</label>
                        <select class="form-control" name="nationality" id="nationality" required>
                            <option>Malaysian</option>
                            <option>Non-Malaysian</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="agerange" class="form-label">Age Range</label>
                        <div class="d-flex">
                            <input type="number" class="form-control w-25 me-2" name="age_min" id="age_min" min="16" required placeholder="Min Age">
                            <div class="d-flex">
                                <p class="form-label pe-2">to</p>
                            </div>
                            <input type="number" class="form-control w-25" name="age_max" id="age_max" min="16" required placeholder="Max Age">
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <legend>Muslim Friendly</legend>
                        <label><input type="radio" name="muslimfriendly" value="1" required> Yes</label>
                        <label><input type="radio" name="muslimfriendly" value="0" required> No</label>
                    </fieldset>

                    <fieldset class="form-group">
                        <legend>Food Provided</legend>
                        <label><input type="radio" name="foodprovision" value="1" required> Yes</label>
                        <label><input type="radio" name="foodprovision" value="0" required> No</label>
                    </fieldset>

                    <fieldset class="form-group">
                        <legend>Transport Provided</legend>
                        <label><input type="radio" name="transportprovision" value="1" required> Yes</label>
                        <label><input type="radio" name="transportprovision" value="0" required> No</label>
                    </fieldset>

                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button type="submit" name="createpost-submit" class="btn btn-success w-25">Submit</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#clearFormModal">
                            Clear Form
                        </button>
                    </div>
                </form>
            </div>
            <!-- Clear Form Confirmation Modal -->
            <div class="modal fade" id="clearFormModal" tabindex="-1" aria-labelledby="clearFormModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="clearFormModalLabel">Confirm Clear Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to clear all the fields? This action cannot be undone.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmClearForm">Clear
                                Form</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
</body>
<script>
    const form = document.getElementById("profileForm");
    const confirmClearButton = document.getElementById("confirmClearForm");
    const taskPhotoContainer = document.getElementById("task-photo-container");
    const taskPhotoInput = document.getElementById("task-photo");

    confirmClearButton.addEventListener("click", function() {
        // Reset the form
        form.reset();

        // Clear image preview
        if (taskPhotoContainer) {
            taskPhotoContainer.src = "";
        }

        // Clear the file input (to prevent reselecting the same file)
        if (taskPhotoInput) {
            taskPhotoInput.value = "";
        }

        // Close the modal after clearing
        const modal = bootstrap.Modal.getInstance(document.getElementById("clearFormModal"));
        modal.hide();
    });
</script>

</html>
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
        <?php
            include 'topnav.php'
        ?>

        <main id="profilemainid">
            <h4 class="mt-3 mb-4 text-center">Post a Task</h4>
            <section class="createprofilemain">
                <?php
                        if (isset($_SESSION['message'])) {
                            echo "<div class='alert alert-primary mt-3'>" . $_SESSION['message'] . "</div>";
                            unset($_SESSION['message']);
                        }
                    ?>
                <div class="profile-form mt-3">
                    <form id="profileForm" action="createpost_process.php" method="post" class="createpost-form">
                        <div class="form-row">
                            <label for="tasktitle" class="form-label">Task Title</label>
                            <input type="text" class="form-control" name="tasktitle" id="tasktitle" required>
                        </div>

                        <div class="form-row">
                            <label for="taskdescription" class="form-label">Task Description</label>
                            <textarea class="form-control" name="taskdescription" id="taskdescription" rows="4" required></textarea>
                        </div>

                        <div class="form-row">
                            <label for="taskdate" class="form-label">Task Date</label>
                            <input type="date" class="form-control" name="taskdate" id="taskdate" required>
                        </div>

                        <div class="form-row">
                            <label for="taskduration" class="form-label">Task Duration</label>
                            <input type="text" class="form-control" name="taskduration" id="taskduration" required>
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
                            <input type="text" class="form-control" name="gender" id="gender" required>
                        </div>

                        <div class="form-row">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" id="nationality" required>
                        </div>

                        <div class="form-row">
                            <label for="agerange" class="form-label">Age Range</label>
                            <input type="text" class="form-control" name="agerange" id="agerange" required>
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

                        <button type="submit" name="createpost-submit" class="btn btn-primary">Submit</button>
                    </form>                    
                </div>

            </section>
        </main>

        <script src="../assets/js/app.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

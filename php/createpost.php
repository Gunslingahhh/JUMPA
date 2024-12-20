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
                            <input type="radio" class="form-check-input" name="muslimfriendly" value="1" id="muslimfriendly1" required>
                            <label class="form-check-label" for="muslimfriendly1">
                                Yes
                            </label>
                            <input type="radio" class="form-check-input" name="muslimfriendly" value="0" id="muslimfriendly2" required>
                            <label class="form-check-label" for="muslimfriendly2">
                                No
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Food Provided?</label>
                            <input type="radio" class="form-check-input" name="foodprovision" value="1" id="foodprovision1" required>
                            <label class="form-check-label" for="foodprovision1">
                                Yes
                            </label>
                            <input type="radio" class="form-check-input" name="foodprovision" value="0" id="foodprovision2" required>
                            <label class="form-check-label" for="foodprovision2">
                                No
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Transport Provided?</label>
                            <input type="radio" class="form-check-input" name="transportprovision" value="1" id="transportprovision1" required>
                            <label class="form-check-label" for="transportprovision1">
                                Yes
                            </label>
                            <input type="radio" class="form-check-input" name="transportprovision" value="0" id="transportprovision2" required>
                            <label class="form-check-label" for="transportprovision2">
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

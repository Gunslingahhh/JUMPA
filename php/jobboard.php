<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Employee Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/styles.css">

        <!-- Standard Favicon -->
        <link rel="icon" type="image/x-icon" href="../assets/favicon/favicon.ico">

        <!-- PNG Favicons -->
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">

        <!-- Apple Touch Icon (for iPhones/iPads) -->
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-touch-icon.png">

        <!-- Android Chrome Icons -->
        <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-chrome-192x192.png">
        <link rel="icon" type="image/png" sizes="512x512" href="../assets/favicon/android-chrome-512x512.png">

    </head>

    <body class="jobboard-body">
        <?php
        include "topnav.php";
        ?>

        <!-- Main Content -->
        <main class="employee-dashboard">
            <div class="container">
                <!-- Page Title -->
                <div class="d-flex justify-content-between align-items-center my-4">
                    <h4 class="mx-5 text-center">Job Posts</h4>
                    <div class="createpost-div-link mx-5">
                        <a href="createpost.php" class="btn btn-outline-success px-4 py-2">Create Post</a>
                    </div>

                </div>
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger mt-2 text-center'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }

                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success mt-2 text-center'>" . $_SESSION['message'] . "</div>";
                    unset($_SESSION['message']); // Clear the error message
                }
                ?>

                <!-- Tab Content -->
                <div class="tab-content" id="JobsTabsContent">
                    <div class="row">
                        <?php
                        $detail_check = $conn->prepare("SELECT t.* FROM task t WHERE t.task_status=0;");
                        $detail_check->execute();
                        $detail_result = $detail_check->get_result();

                        while ($user_row = $detail_result->fetch_assoc()) {
                            $taskOwner = "";
                            if ($user_row['user_id'] == $user_id) {
                                $taskOwner = "Your post";
                            } else {
                                $taskOwner = "";
                            }
                            echo '<div class="col-xs-12 col-md-4 col-lg-3 pb-3">';
                            echo '    <div class="card h-100">'; // h-100 to ensure equal height inside grid
                            echo '        <div class="w-100" style="height: 190px; background-image: url(\'' . htmlspecialchars($user_row['task_photo']) . '\'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>';
                            echo '        <div class="card-body d-flex flex-column justify-content-between">';
                            echo '            <div>';
                            echo '                <h5 class="card-title truncate-multiline">' . htmlspecialchars($user_row['task_title']) . '</h5>';
                            echo '                <p class="card-text truncate-multiline">' . htmlspecialchars($user_row['task_description']) . '</p>';
                            echo '            </div>';
                            echo '            <div class="d-flex justify-content-between align-items-center mt-2">';
                            echo '                <a href="jobboard_detail.php?task_id=' . $user_row['task_id'] . '" class="btn btn-outline-primary btn-sm">View Details &nbsp;<i class="fas fa-arrow-right"></i></a>';
                                if ($user_row['user_id'] == $_SESSION['user_id']) {
                                    echo '<a href="editpost.php?task_id=' . $user_row['task_id'] . '" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i>&nbsp;Edit</a>';
                                }
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                            
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
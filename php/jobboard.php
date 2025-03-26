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
                    <!-- Priority Tab -->
                    <div class="tab-pane fade show active mb-3" id="priority" role="tabpanel"
                        aria-labelledby="priority-tab">
                        <div class="table-responsive">
                            <table class="table table-hover priority-Jobs-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $detail_check = $conn->prepare("SELECT t.*
                                                                    FROM task t
                                                                    WHERE t.task_status=0;");
                                    $detail_check->execute();
                                    $detail_result = $detail_check->get_result();

                                    while ($user_row = $detail_result->fetch_assoc()) {
                                        $taskOwner = "";
                                        if ($user_row['user_id'] == $user_id) {
                                            $taskOwner = "Your post";
                                        } else {
                                            $taskOwner = "";
                                        }
                                        echo "<tr onclick='window.location.href = \"jobboard_detail.php?task_id=" . $user_row['task_id'] . "\"' style='cursor: pointer;'>";
                                        echo "<td>" . htmlspecialchars($user_row['task_title']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user_row['task_description']) . " " . "<span class='bg-danger text-white py-1 rounded fw-bold'>" . $taskOwner . "</span>" . "</td>";
                                        echo "<td>" . htmlspecialchars($user_row['task_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($user_row['task_location']) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
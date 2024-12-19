<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

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
<body>
    <?php
        include "topnav.php";
    ?>

    <!-- Main Content -->
    <main class="employee-dashboard">
        <div class="container">
            <!-- Page Title -->
            <h4 class="mb-4 text-center">Job Board</h4>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs custom-nav-tabs" id="JobsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="priority-tab" data-bs-toggle="tab" data-bs-target="#priority" type="button" role="tab">Priority</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">Active</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered" type="button" role="tab">Delivered</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">Completed</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab">Cancelled</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="JobsTabsContent">
                <!-- Priority Tab -->
                <div class="tab-pane fade show active mb-3" id="priority" role="tabpanel" aria-labelledby="priority-tab">
                    <h5 class="mt-3 mb-3">Priority Jobs</h5>
                    <div class="table-responsive">
                        <table class="table priority-Jobs-table">
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
                                $detail_check = $conn->prepare("SELECT * FROM task");
                                $detail_check->execute();
                                $detail_result = $detail_check->get_result();

                                while ($user_row = $detail_result->fetch_assoc()) {
                                    echo "<tr onclick='window.location.href = \"jobboard_detail.php?task_id=" . $user_row['task_id'] . "\"' style='cursor: pointer;'>";
                                    echo "<td>" . htmlspecialchars($user_row['task_title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_description']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_location']) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade mb-3" id="active" role="tabpanel" aria-labelledby="active-tab">
                    <h5 class="mt-3 mb-3">Active Jobs</h5>
                    <p class="text-danger">No late Jobs at the moment.</p>
                </div>

                <div class="tab-pane fade mb-3" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                    <h5 class="mt-3 mb-3">Delivered Jobs</h5>
                    <p class="text-danger">No delivered Jobs at the moment.</p>
                </div>

                <div class="tab-pane fade mb-3" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <h5 class="mt-3 mb-3">Completed Jobs</h5>
                    <p>All tasks have been successfully completed!</p>
                </div>

                <div class="tab-pane fade mb-3" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <h5 class="mt-3 mb-3">Cancelled Jobs</h5>
                    <p class="text-muted">No cancelled Jobs at the moment.</p>
                </div>
            </div>
        </div>
    </main>
    <?php /*include 'footer.php';*/ ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
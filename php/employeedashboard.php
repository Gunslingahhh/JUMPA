<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id=$_SESSION['user_id'];
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
            <h4 class="mb-4 text-center">Dashboard</h4>
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

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs custom-nav-tabs" id="JobsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
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
                <div class="tab-pane show active fade mb-3" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <h5 class="mt-3 mb-3">Pending Jobs</h5>
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
                                $detail_check = $conn->prepare("SELECT
                                                                    t.user_id,
                                                                    t.task_id,
                                                                    t.task_title,
                                                                    t.task_description,
                                                                    t.task_date,
                                                                    t.task_location,
                                                                    (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ) AS related_user_ids
                                                                FROM
                                                                    task t
                                                                WHERE
                                                                    t.task_status = 1 AND FIND_IN_SET(?, (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ));");
                                $detail_check->bind_param("i", $user_id);
                                $detail_check->execute();
                                $detail_result = $detail_check->get_result();

                                while ($user_row = $detail_result->fetch_assoc()) {
                                    $taskOwner="";
                                    if ($user_row['user_id'] == $user_id){
                                        $taskOwner = " (Your post)";
                                    }else{
                                        $taskOwner = "";
                                    }
                                    echo "<tr onclick='window.location.href = \"job_detail.php?task_id=" . $user_row['task_id'] . "\"' style='cursor: pointer;'>";
                                    echo "<td>" . htmlspecialchars($user_row['task_title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_description']) . "<span class='fw-bold'>" . $taskOwner . "</span>" . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_location']) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade mb-3" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <h5 class="mt-3 mb-3">Completed Jobs</h5>
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
                                $detail_check = $conn->prepare("SELECT
                                                                    t.user_id,
                                                                    t.task_id,
                                                                    t.task_title,
                                                                    t.task_description,
                                                                    t.task_date,
                                                                    t.task_location,
                                                                    (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ) AS related_user_ids
                                                                FROM
                                                                    task t
                                                                WHERE
                                                                    t.task_status = 2 AND FIND_IN_SET(?, (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ));");
                                $detail_check->bind_param("i", $user_id);
                                $detail_check->execute();
                                $detail_result = $detail_check->get_result();

                                while ($user_row = $detail_result->fetch_assoc()) {
                                    $taskOwner="";
                                    if ($user_row['user_id'] == $user_id){
                                        $taskOwner = " (Your post)";
                                    }else{
                                        $taskOwner = "";
                                    }
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($user_row['task_title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_description']) . "<span class='fw-bold'>" . $taskOwner . "</span>" . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_location']) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade mb-3" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <h5 class="mt-3 mb-3">Cancelled Jobs</h5>
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
                                $detail_check = $conn->prepare("SELECT
                                                                    t.user_id,
                                                                    t.task_id,
                                                                    t.task_title,
                                                                    t.task_description,
                                                                    t.task_date,
                                                                    t.task_location,
                                                                    (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ) AS related_user_ids
                                                                FROM
                                                                    task t
                                                                WHERE
                                                                    t.task_status = 3 AND FIND_IN_SET(?, (
                                                                        SELECT GROUP_CONCAT(DISTINCT u.user_id)
                                                                        FROM user u
                                                                        LEFT JOIN job j ON u.user_id = j.user_id
                                                                        LEFT JOIN task task_inner ON u.user_id = task_inner.user_id
                                                                        WHERE j.task_id = t.task_id OR task_inner.task_id = t.task_id
                                                                    ));");
                                $detail_check->bind_param("i", $user_id);
                                $detail_check->execute();
                                $detail_result = $detail_check->get_result();

                                while ($user_row = $detail_result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($user_row['task_title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user_row['task_description']) . "<span class='fw-bold'>" . $taskOwner . "</span>" . "</td>";
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
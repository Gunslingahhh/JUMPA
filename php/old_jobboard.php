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
    <main>
    <div class="employee-dashboard">
        <h4 class="mb-4 d-flex justify-content-center">Job Board</h4>
        <table class="table">
            <tbody>
                <?php
                    $detail_check = $conn->prepare("SELECT * FROM task");
                    $detail_check->execute();
                    $detail_result = $detail_check->get_result();

                    while ($user_row = $detail_result->fetch_assoc()) {
                        echo "<div onclick='window.location.href = \"jobboard_detail.php?task_id=" . $user_row['task_id'] . "\";' class='col-md-4 gig-card'>";
                        echo "<h3 class='recommended-gig-title'>Title: " . $user_row['task_title'] . "</h3><br>";
                        echo "<p>Description: " . $user_row['task_description'] . "</p><br>";
                        echo "<p>Date: " . $user_row['task_date'] . "</p><br>";
                        echo "<p>Location: " . $user_row['task_location'] . "</p>";
                        echo "</div>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    </main>

    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
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
        <table class="table">
            <tbody>
                <?php
                    $detail_check = $conn->prepare("SELECT * FROM task");
                    $detail_check->execute();
                    $detail_result = $detail_check->get_result();

                    while ($user_row = $detail_result->fetch_assoc()) {
                        echo "<tr onclick='window.location.href = \"jobboard_detail.php?id=" . $user_row['task_id'] . "\";'>";
                        echo "<td>Title: " . $user_row['task_title'] . "</td><br>";
                        echo "<td>Description: " . $user_row['task_description'] . "</td><br>";
                        echo "<td>Date: " . $user_row['task_date'] . "</td><br>";
                        echo "<td>Location: " . $user_row['task_location'] . "</td>";
                        echo "</tr></a>";
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

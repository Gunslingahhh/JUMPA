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

        $id = $_GET['id'];

        $detail_check = $conn->prepare("SELECT * FROM task WHERE task_id = $id");
        $detail_check->execute();
        $detail_result = $detail_check->get_result();

        while ($user_row = $detail_result->fetch_assoc()) {
            $tasktitle = $user_row['task_title'];
            $taskdescription = $user_row['task_description'];
            $taskdate = $user_row['task_date'];
            $taskduration = $user_row['task_duration'];
            $tasklocation = $user_row['task_location'];
            $toolsrequired = $user_row['task_toolsRequired'];
            $pax = $user_row['task_pax'];
            $price = $user_row['task_price'];
            $dresscode = $user_row['task_dressCode'];
            $gender = $user_row['task_gender'];
            $nationality = $user_row['task_nationality'];
            $agerange = $user_row['task_ageRange'];
            $muslimfriendly = $user_row['task_muslimFriendly'];
            $userid = $user_row['user_id'];
        }
    ?>
    <!-- Main Content -->
    <main>
    <div class="employee-dashboard">
        <table class="table">
            <tbody>
                <p><b>Title: </b><?php echo($tasktitle) ?></p>
                <p><b>Description: </b><?php echo($taskdescription) ?></p>
                <p><b>Date: </b><?php echo($taskdate) ?></p>
                <p><b>Duration: </b><?php echo($taskduration) ?></p>
                <p><b>Location: </b><?php echo($tasklocation) ?></p>
                <p><b>Tools Required: </b><?php echo($toolsrequired) ?></p>
                <p><b>Pax: </b><?php echo($pax) ?></p>
                <p><b>Price: </b><?php echo($price) ?></p>
                <p><b>Dress code: </b><?php echo($dresscode) ?></p>
                <p><b>Gender: </b><?php echo($gender) ?></p>
                <p><b>Nationality: </b><?php echo($nationality) ?></p>
                <p><b>Age range: </b><?php echo($agerange) ?></p>
                <p><b>Muslim friendly?: </b><?php echo($muslimfriendly) ?></p>
                <p><b>User id: </b><?php echo($userid) ?></p>
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

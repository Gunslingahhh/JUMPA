<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include "connection.php";

$userName=$_SESSION['username'];
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

        $id = $_GET['task_id'];

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
            $foodProvision = $user_row['task_foodProvision'];
            $transportProvision = $user_row['task_transportProvision'];
            $userid = $user_row['user_id'];
        }
    ?>
    <!-- Main Content -->
    <main>
        <div class="employee-dashboard">
            <div class="gig-card">
                <p><b>Title: </b><?php echo($tasktitle) ?></p>
                <p><b>Description: </b><?php echo($taskdescription) ?></p>
                <p><b>Date: </b><?php echo($taskdate) ?></p>
                <p><b>Duration: </b><?php echo($taskduration) ?></p>
                <p><b>Location: </b><?php echo($tasklocation) ?></p>
                <p><b>Tools Required: </b><?php echo($toolsrequired) ?></p>
                <p><b>Pax: </b><?php echo($pax) ?></p>
                <p><b>Price: RM</b><?php echo($price) ?></p>
                <p><b>Dress code: </b><?php echo($dresscode) ?></p>
                <p><b>Gender: </b><?php echo($gender) ?></p>
                <p><b>Nationality: </b><?php echo($nationality) ?></p>
                <p><b>Age range: </b><?php echo($agerange) ?></p>
                <p><b>Muslim friendly?: </b><?php echo($muslimfriendly) ?></p>
                <p><b>Food provided?: </b><?php echo($foodProvision) ?></p>
                <p><b>Transport provided?: </b><?php echo($transportProvision) ?></p>
                <p><b>User id: </b><?php echo($userid) ?></p>
                <table class="table table-striped">
                    <thead class="thead">
                        <tr>
                            <th scope="col" class="col-2">Profile Picture</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Amount bid</th>
                        </tr>
                    </thead>
                </table>
            </div>
                
                            <?php
                                if ($_SESSION['user_id'] != $userid) {
                                    $sql = "SELECT u.user_photo, u.user_fullname, b.bidding_amount
                                            FROM bidding b
                                            INNER JOIN user u ON b.user_id = u.user_id
                                            WHERE b.task_id = ?";

                                    $stmt=$conn->prepare($sql);
                                    $stmt->bind_param("i",$id);

                                    if ($stmt->execute()) {
                                        echo "
                                        <div class='d-flex justify-content-center'>
                    <div class='card w-75'>
                        <div class='card-body'>
                                    <form>
                                        <div class='row d-flex justify-content-center'>
                                            <div class='col-md-6 mb-3'>
                                                <div class='card'>
                                                    <div class='card-body text-center'>
                                                        <h5 class='card-title'>Starting Bid</h5>
                                                        <p class='card-text'>RM {$price}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='card'>
                                                    <div class='card-body text-center'>
                                                        <h5 class='card-title'>Latest Bid</h5>
                                                        <p class='card-text'>RM {$price}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-6'>
                                                <div class='card'>
                                                    <div class='card-body text-center'>
                                                        <h5 class='card-title'>Your Bid</h5>
                                                        <div class='input-group mb-3 d-flex justify-content-center'>
                                                            <span class='input-group-text'>RM</span>
                                                            <input type='number' class='form-control-sm text-center' name='bidding_amount' min='{$price}' value='{$price}'>
                                                        </div>
                                                        <button type='submit' class='btn btn-primary'>Place Your Bid</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    </div>
                </div>
                                    ";
                                        exit();
                                    } else {
                                        //do nothing
                                    }

                                    
                                } else {
                                    // Do nothing
                                }
                            ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

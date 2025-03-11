<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
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

        $id = isset($_GET['task_id']) ? intval($_GET['task_id']) : 0;
        $user_id = $_SESSION['user_id'];

        $detail_check = $conn->prepare("SELECT * FROM task WHERE task_id = ?");
        $detail_check->bind_param("i", $id);
        $detail_check->execute();
        $detail_result = $detail_check->get_result();

        while ($user_row = $detail_result->fetch_assoc()) {
            $tasktitle = $user_row['task_title'];
            $taskdescription = $user_row['task_description'];
            $taskphoto = $user_row['task_photo'];
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
            $muslimfriendly = ($user_row['task_muslimFriendly'] == 1 ? "Yes" : "No");
            $foodProvision = ($user_row['task_foodProvision'] == 1 ? "Yes" : "No");
            $transportProvision = ($user_row['task_transportProvision'] == 1 ? "Yes" : "No");
            $userid = $user_row['user_id'];
        }
    ?>
    <!-- Main Content -->
    <main>
        <div class="employee-dashboard">
            <div class="container">
                <!-- Page Title -->
                <h4 class="mb-4 text-center">Job Details & Bidding</h4>

                <!-- Task Details -->
                <div class="row full-height">
                    <!-- Task Details Column -->
                    <div class="col-12 mb-0">
                        <div class="container task-details-card">
                            <!-- Title -->
                            <div class="col-12 mb-3">
                                <h2 class="text-center"><?php echo($tasktitle); ?></h2>
                            </div>

                            <!-- Picture -->
                            <div class="col-12 mb-4 text-center">
                                <div class="container form-control w-50 h-25">
                                    <img id="task-photo-container" src="<?php echo($taskphoto); ?>"
                                        class="img-fluid rounded shadow" alt="Task Photo">
                                </div>
                            </div>

                            <!-- Information -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Description:</strong> <?php echo($taskdescription); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Date:</strong> <?php echo($taskdate); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Duration:</strong> <?php echo($taskduration); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Location:</strong> <?php echo($tasklocation); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Tools Required:</strong> <?php echo($toolsrequired); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Pax:</strong> <?php echo($pax); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Price:</strong> RM <?php echo($price); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Dress Code:</strong> <?php echo($dresscode); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Gender:</strong> <?php echo($gender); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Nationality:</strong> <?php echo($nationality); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Age Range:</strong> <?php echo($agerange); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Muslim Friendly:</strong> <?php echo($muslimfriendly); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Food Provided:</strong> <?php echo($foodProvision); ?></p>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <p><strong>Transport Provided:</strong> <?php echo($transportProvision); ?></p>
                                    </div>
                                </div>
                            </div>
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

                    <!-- Bidding Information Column -->
                    <div class="col-12 mb-0">
                        <div class="p-4 bidding-info-card">
                            <h5 class="mb-3">Bidding Information</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Profile Picture</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Amount Bid</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT u.user_photo, u.user_fullname, b.bidding_amount, b.bidding_id, u.user_contactNumber, u.user_email, u.user_gender, u.user_age, b.bidding_time, u.user_id
                                            FROM bidding b
                                            LEFT JOIN job j ON b.bidding_id = j.bidding_id
                                            INNER JOIN user u ON u.user_id = b.user_id
                                            WHERE j.bidding_id IS NULL AND b.task_id=?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bind_param("i", $id);
                                    if ($stmt->execute()) {
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>"; // Added onclick and style
                                            echo "<td><img src='{$row['user_photo']}' id='user-photo' alt='Profile Picture' class='rounded-circle' width='30px' height='30px'></td>";
                                            echo "<td>{$row['user_fullname']}</td>";
                                            echo "<td>RM {$row['bidding_amount']}</td>";
                                            if ($_SESSION['user_id'] == $userid){
                                                echo "<td><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#" . $row['bidding_id'] . "'>Accept</button></td>";
                                            }
                                            echo "</tr>";

                                            echo "
                                            <div class='modal fade' id='" . $row['bidding_id'] . "' tabindex='-1' aria-labelledby='" . $row['bidding_id'] . "Label' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header text-center'>
                                                            <h1 class='modal-title fs-4 fw-bold' id='" . $row['bidding_id'] . "Label'>Accept this bid?</h1>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <img src='{$row['user_photo']}' id='modal-photo' class='rounded-circle mb-2'>
                                                            <div class='d-flex justify-content-center'>
                                                                <a href='https://wa.me/{$row['user_contactNumber']}' class='btn btn-success mt-3 mb-5 text-decoration-none'>Contact me on WhatsApp</a>
                                                            </div>
                                                            <p><span class='fw-bold'>Name:</span> {$row['user_fullname']}</p>
                                                            <p><span class='fw-bold'>Contact Number:</span> {$row['user_contactNumber']}</p>
                                                            <p><span class='fw-bold'>E-mail:</span> {$row['user_email']}</p>
                                                            <p><span class='fw-bold'>Gender:</span> {$row['user_gender']}</p>
                                                            <p><span class='fw-bold'>Age:</span> {$row['user_age']}</p>
                                                            <p><span class='fw-bold'>Bidding amount:</span> RM {$row['bidding_amount']}</p>
                                                            <p><span class='fw-bold'>Bidding time:</span> {$row['bidding_time']}</p>
                                                            
                                                        </div>
                                                        <div class='modal-footer justify-content-center'>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                            <a href='accept_bid.php?bidding_id={$row['bidding_id']}&task_id={$id}&user_id={$row['user_id']}' class='btn btn-danger'>Accept bid</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php 
                    if ($_SESSION['user_id'] == $userid){
                        echo "
                        <div class='col-12'>
                            <div class='p-4 bidding-form-card'>
                                <h5>Employee</h5>
                                <table class='table table-hover'>
                                    <thead class='table-light'>
                                    </thead>
                                    <tbody>";
                                    $sql = $conn->prepare("SELECT *
                                    FROM user u
                                    INNER JOIN job j ON j.user_id = u.user_id
                                    INNER JOIN bidding b ON b.bidding_id = j.bidding_id
                                    WHERE j.task_id=?");

                                    $sql->bind_param("i", $id);
                                    if ($sql->execute()) {
                                        $result = $sql->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr role='button' data-bs-toggle='modal' data-bs-target='#" . $row['bidding_id'] . "'>"; // Added onclick and style
                                            echo "
                                            <td>
                                                <div class='rounded-circle' style='width: 40px; height: 40px; overflow: hidden; display: flex; justify-content: center; align-items: center;'>
                                                    <img src='{$row['user_photo']}' id='user-photo' alt='Profile Picture' class='rounded-circle' width='40px' height='40px'>
                                                </div>
                                            </td>";
                                            echo "<td>{$row['user_fullname']}</td>";
                                            echo "<td>RM {$row['bidding_amount']}</td>";
                                            echo "</tr>";

                                            echo "
                                                            <div class='modal fade' id='" . $row['bidding_id'] . "' tabindex='-1' aria-labelledby='" . $row['bidding_id'] . "Label' aria-hidden='true'>
                                                                <div class='modal-dialog modal-dialog-centered'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header text-center'>
                                                                            <h1 class='modal-title fs-4 fw-bold' id='" . $row['bidding_id'] . "Label'>Employee information</h1>
                                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                        </div>
                                                                        <div class='modal-body'>
                                                                            <div class='d-flex flex-column align-items-center'>
                                                                                <img src='{$row['user_photo']}' id='modal-photo' class='rounded-circle mb-2'>
                                                                                <a href='https://wa.me/{$row['user_contactNumber']}' class='btn btn-success mt-3 mb-5 text-decoration-none'>Contact me on WhatsApp</a>
                                                                            </div>
                                                                            <p><span class='fw-bold'>Name:</span> {$row['user_fullname']}</p>
                                                                            <p><span class='fw-bold'>Contact Number:</span> {$row['user_contactNumber']}</p>
                                                                            <p><span class='fw-bold'>E-mail:</span> {$row['user_email']}</p>
                                                                            <p><span class='fw-bold'>Gender:</span> {$row['user_gender']}</p>
                                                                            <p><span class='fw-bold'>Age:</span> {$row['user_age']}</p>
                                                                            <p><span class='fw-bold'>Bidding amount:</span> RM {$row['bidding_amount']}</p>
                                                                            <p><span class='fw-bold'>Bidding time:</span> {$row['bidding_time']}</p>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                        }
                                    }
                            echo
                                    "</tbody>
                                </table>
                            </div>
                        </div>
                        ";
                    }
                    ?>

                    <!-- Bidding Form Column -->
                    <?php 
                    $biddingForm = $conn->prepare("SELECT bidding_id FROM bidding WHERE user_id=? AND task_id=?");
                    $biddingForm->bind_param("ii", $user_id, $id);
                    $biddingForm->execute();
                    $biddingFormResult = $biddingForm->get_result();

                    if ($user_id != $userid && $biddingFormResult->num_rows < 1) {?>
                    <div class="col-12">
                        <div class="bidding-form-card">
                            <h5 class="mb-3">Place Your Bid</h5>
                            <form method="POST" action="place_bid.php?task_id=<?php echo htmlspecialchars($id); ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="starting-bid-card">
                                            <div class="starting-bid-card-body text-center">
                                                <h6>Starting Bid</h6>
                                                <p>RM <?php echo($price); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="latest-bid-card">
                                            <div class="latest-bid-card-body text-center">
                                                <h6>Highest Bid</h6>
                                                <?php
                                                    $highestPriceStmt = $conn->prepare("SELECT MAX(bidding_amount) AS highest_bid FROM bidding WHERE task_id = ?");
                                                    $highestPriceStmt->bind_param("i",$id);

                                                    if($highestPriceStmt->execute()){
                                                        $highestPrice = $highestPriceStmt->get_result();
                                                        while($row = $highestPrice->fetch_assoc()){
                                                            echo"RM " . $row['highest_bid'];
                                                        }
                                                    }else{
                                                        //Do nothing
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="your-bid-card">
                                            <div class="your-bid-card-body text-center">
                                                <h6>Your Bid</h6>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">RM</span>
                                                    <input type="number" class="form-control" name="bidding_amount"
                                                        min="<?php echo($price); ?>" value="<?php echo($price); ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Place Your Bid</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }else{
                        //Do nothing
                    }?>
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
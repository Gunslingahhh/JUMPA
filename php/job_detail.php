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

        $id = $_GET['task_id'];
        $user_id = $_SESSION['user_id'];

        $detail_check = $conn->prepare("SELECT * FROM task 
                                        WHERE task_status = '1' AND user_id = ?;");
        
        $detail_check->bind_param("i", $user_id);
        $detail_check->execute();
        $detail_result = $detail_check->get_result();

        while ($user_row = $detail_result->fetch_assoc()) {
            echo "
            <main>
                <div class='employee-dashboard pb-0'>            
                    <div class='container w-75'>
                        <h4 class='mb-4 text-center'>Job Details</h4>
                        <div class='row full-height'>
                            <div class='col-12 mb-4'>
                                <div class='container task-details-card'>
                                    <h5 class='mb-4 text-center'>Task Details</h5>
                                    <div class='row details-p'>
                                        <div class='col-lg-3 col-md-6 col-sm-12'>
                                            <p><strong>Title:</strong> " . htmlspecialchars($user_row['task_title']) . "</p>
                                            <p><strong>Description:</strong> " . htmlspecialchars($user_row['task_description']) . "</p>
                                            <p><strong>Date:</strong> " . htmlspecialchars($user_row['task_date']) . "</p>
                                            <p><strong>Duration:</strong> " . htmlspecialchars($user_row['task_duration']) . "</p>
                                            <p><strong>Location:</strong> " . htmlspecialchars($user_row['task_location']) . "</p>
                                            <p><strong>Tools Required:</strong> " . htmlspecialchars($user_row['task_toolsRequired']) . "</p>
                                            <p><strong>Pax:</strong> " . htmlspecialchars($user_row['task_pax']) . "</p>
                                            <p><strong>Price: </strong> RM " . htmlspecialchars($user_row['task_price']) . "</p>
                                            <p><strong>Dress Code:</strong> " . htmlspecialchars($user_row['task_dressCode']) . "</p>
                                            <p><strong>Gender:</strong> " . htmlspecialchars($user_row['task_gender']) . "</p>
                                            <p><strong>Nationality:</strong> " . htmlspecialchars($user_row['task_nationality']) . "</p>
                                            <p><strong>Age Range:</strong> " . htmlspecialchars($user_row['task_ageRange']) . "</p>
                                            <p><strong>Muslim Friendly:</strong> " . htmlspecialchars($user_row['task_muslimFriendly'] == 1 ? "Yes" : "No") . "</p>
                                            <p><strong>Food Provided?:</strong> " . htmlspecialchars($user_row['task_foodProvision'] == 1 ? "Yes" : "No") . "</p>
                                            <p><strong>Transport Provided?:</strong> " . htmlspecialchars($user_row['task_transportProvision'] == 1 ? "Yes" : "No") . "</p>
                                        </div>
                                    </div>
                                </div>"; ?>
                                <div class="container task-details-card">
                                    <h5 class="mb-4 text-center">Employee</h5>
                                    <div class="row details-p">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="table-light">
                                                    </thead>
                                                    <tbody>
                                                    <?php
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
                                                                                <h1 class='modal-title fs-4 fw-bold' id='" . $row['bidding_id'] . "Label'>Employee detail</h1>
                                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                                            </div>
                                                                            <div class='modal-body'>
                                                                                <img src='{$row['user_photo']}' id='modal-photo' class='rounded-circle mb-2'>
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
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='d-flex justify-content-center mt-5'>
                                    <button type="button" class="btn btn-danger me-5" data-bs-toggle="modal" data-bs-target="#cancelJobModal">Cancel Job</button>
                                    <button type="button" class="btn btn-success ms-5" data-bs-toggle="modal" data-bs-target="#completeJobModal">Mark job as complete</button>
                                </div>

                                <div class='modal fade' id='cancelJobModal' tabindex='-1' aria-labelledby='cancelJobModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='cancelJobModalLabel'>Cancel this job?</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <p>Are you sure you want to cancel this job?</p>
                                                <p class="text-danger">This action cannot be undone!</p>
                                            </div>
                                            <div class='modal-footer justify-content-center'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                                                <a href='cancel_job.php?task_id=<?php echo htmlspecialchars($id); ?>' class='btn btn-danger'>Yes, cancel this job.</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class='modal fade' id='completeJobModal' tabindex='-1' aria-labelledby='completeJobModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='completeJobModalLabel'>Mark job as complete?</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <p>Are you sure you want to mark this job as complete?</p>
                                            </div>
                                            <div class='modal-footer justify-content-center'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>No</button>
                                                <a href='complete_job.php?task_id=<?php echo htmlspecialchars($id); ?>' class='btn btn-success'>Yes, mark as complete.</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php 
            }
        ?>
    
    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
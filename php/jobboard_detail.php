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
    <style>
        /* Main container styling */
        main {
            display: flex;
            flex-wrap: wrap;
            min-height: 100vh;
            padding: 15px;
            background-color: #f0f0f0;
        }

        /* Card Styling */
        .task-details-card, .bidding-info-card, .bidding-form-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px 0;
            height: 100%;
            transition: all 0.3s ease;
            overflow-x: hidden;
            overflow-y: auto;
            word-wrap: break-word;
        }

        /* Card Header Styling */
        .task-details-card h5, .bidding-info-card h5, .bidding-form-card h5 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        /* Task Details Card Body */
        .task-details-card p {
            font-size: 1rem;
            margin: 10px 0;
            color: #555;
        }

        .task-details-card p strong {
            color: #333;
        }

        /* Bidding Info Card Table */
        .bidding-info-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .bidding-info-card table th, .bidding-info-card table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .bidding-info-card table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        /* Bidder Profile Picture Styling */
        .bidding-info-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Bidding Form Card */
        .bidding-form-card .starting-bid-card, .bidding-form-card .latest-bid-card {
            background-color: #f7f7f7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .bidding-form-card .starting-bid-card-body, .bidding-form-card .latest-bid-card-body {
            text-align: center;
        }

        .bidding-form-card .your-bid-card {
            background-color: #f7f7f7;
            border-radius: 8px;
            padding: 20px;
        }

        .bidding-form-card .your-bid-card-body {
            text-align: center;
        }

        .bidding-form-card .input-group-text {
            font-size: 1rem;
        }

        .bidding-form-card .form-control {
            font-size: 1rem;
            padding: 10px;
        }

        .bidding-form-card .btn-primary {
            font-size: 1rem;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
        }

        /* Responsive Card Adjustments */
        @media (max-width: 992px) {
            .task-details-card, .bidding-info-card, .bidding-form-card {
                padding: 15px;
            }

            .task-details-card h5, .bidding-info-card h5, .bidding-form-card h5 {
                font-size: 1.1rem;
            }

            /* Prevent scrolling on small screens */
            .task-details-card, .bidding-info-card, .bidding-form-card {
                overflow-y: visible;
                max-height: none;
            }
        }

        @media (max-width: 768px) {
            .task-details-card, .bidding-info-card, .bidding-form-card {
                padding: 10px;
            }

            .task-details-card h5, .bidding-info-card h5, .bidding-form-card h5 {
                font-size: 1rem;
            }

            .bidding-form-card .btn-primary {
                width: 100%;
            }

            /* Prevent vertical scrolling on small screens */
            .task-details-card, .bidding-info-card, .bidding-form-card {
                overflow-y: visible;
                max-height: none;
            }
        }

        /* Enable Y scrolling on larger screens */
        @media (min-width: 992px) {
            .task-details-card, .bidding-info-card, .bidding-form-card {
                overflow-y: auto;
                max-height: 80vh;  /* Limit height for scrolling */
            }
        }

        /* Flexbox Layout for the Task Details, Bidding Info, and Form */
        .employee-dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .employee-dashboard .col-flex {
            flex: 1 1 33%; /* Default: 3 columns on large screens */
            padding: 15px;
            box-sizing: border-box;
        }

        /* Adjust for medium screens: 2 columns */
        @media (max-width: 992px) {
            .employee-dashboard .col-flex {
                flex: 1 1 50%; /* 2 columns on medium screens */
            }
        }

        /* Adjust for small screens: 1 column */
        @media (max-width: 768px) {
            .employee-dashboard .col-flex {
                flex: 1 1 100%; /* 1 column on small screens */
            }
        }

        /* Ensure cards take full width when only one is present */
        @media (max-width: 768px) {
            .employee-dashboard .col-flex {
                width: 100%;
            }
        }

    </style>
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
        <div class="container">
            <!-- Task Details -->
            <div class="row full-height">
                <!-- Task Details Column -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="task-details-card">
                        <h5 class="mb-3">Task Details</h5>
                        <p><strong>Title:</strong> <?php echo($tasktitle) ?></p>
                        <p><strong>Description:</strong> <?php echo($taskdescription) ?></p>
                        <p><strong>Date:</strong> <?php echo($taskdate) ?></p>
                        <p><strong>Duration:</strong> <?php echo($taskduration) ?></p>
                        <p><strong>Location:</strong> <?php echo($tasklocation) ?></p>
                        <p><strong>Tools Required:</strong> <?php echo($toolsrequired) ?></p>
                        <p><strong>Pax:</strong> <?php echo($pax) ?></p>
                        <p><strong>Price:</strong> RM <?php echo($price) ?></p>
                        <p><strong>Dress Code:</strong> <?php echo($dresscode) ?></p>
                        <p><strong>Gender:</strong> <?php echo($gender) ?></p>
                        <p><strong>Nationality:</strong> <?php echo($nationality) ?></p>
                        <p><strong>Age Range:</strong> <?php echo($agerange) ?></p>
                        <p><strong>Muslim Friendly:</strong> <?php echo($muslimfriendly) ?></p>
                        <p><strong>Food Provided:</strong> <?php echo($foodProvision) ?></p>
                        <p><strong>Transport Provided:</strong> <?php echo($transportProvision) ?></p>
                        <p><strong>User ID:</strong> <?php echo($userid) ?></p>
                    </div>
                </div>

                <!-- Bidding Information Column -->
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="bidding-info-card">
                        <h5 class="mb-3">Bidding Information</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Profile Picture</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Amount Bid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT u.user_photo, u.user_fullname, b.bidding_amount, u.user_id
                                        FROM bidding b
                                        INNER JOIN user u ON b.user_id = u.user_id
                                        WHERE b.task_id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                if ($stmt->execute()) {
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>
                                            <a href='bidder_profile.php?user_id=" . urlencode($row['user_id']) . 
                                                "&user_fullname=" . urlencode($row['user_fullname']) . "'>
                                            <img src='" . htmlspecialchars($row['user_photo']) . "' class='rounded-circle' style='width: 50px; height: 50px;'>
                                            </a>
                                        </td>";
                                        echo "<td>" . htmlspecialchars($row['user_fullname']) . "</td>";
                                        echo "<td>RM " . htmlspecialchars($row['bidding_amount']) . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Bidding Form Column -->
                <?php if ($_SESSION['user_id'] != $userid): ?>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="bidding-form-card">
                        <h5 class="mb-3">Place Your Bid</h5>
                        <form method="POST" action="place_bid.php">
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
                                            <h6>Latest Bid</h6>
                                            <p>RM <?php echo($price); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="your-bid-card">
                                        <div class="your-bid-card-body text-center">
                                            <h6>Your Bid</h6>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">RM</span>
                                                <input type="number" class="form-control" name="bidding_amount" min="<?php echo($price); ?>" value="<?php echo($price); ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Place Your Bid</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>
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

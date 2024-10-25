<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Board with Bids</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Include Top Navigation -->
    <?php include "topnav.php"; ?>

    <!-- Main Container -->
    <div class="container my-4">
        <!-- Job Board Title -->
        <h3 class="mb-4">Job Board</h3>

        <!-- Job Task Information -->
        <div class="row mb-4">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Task Title</th>
                            <th>Task Date/Time</th>
                            <th>Price</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tasks = [
                                [
                                    'title' => 'Fix door',
                                    'date' => '24/05',
                                    'time' => '8 AM',
                                    'price' => 'RM50',
                                    'location' => 'Kuala Lumpur'
                                ],
                                [
                                    'title' => 'Paint wall',
                                    'date' => '25/05',
                                    'time' => '9 AM',
                                    'price' => 'RM60',
                                    'location' => 'Johor Bahru'
                                ],
                                [
                                    'title' => 'Install light',
                                    'date' => '26/05',
                                    'time' => '10 AM',
                                    'price' => 'RM70',
                                    'location' => 'Penang'
                                ],[
                                    'title' => 'Paint ceiling',
                                    'date' => '25/11',
                                    'time' => '9 AM',
                                    'price' => 'RM60',
                                    'location' => 'Kuching'
                                ],
                            ];

                            foreach ($tasks as $task) {
                                echo "<tr>
                                        <td>{$task['title']}</td>
                                        <td>{$task['date']} {$task['time']}</td>
                                        <td>{$task['price']}</td>
                                        <td>{$task['location']}</td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bids Section -->
        <div class="row">
            <div class="col-12">
                <h4>Bids</h4>
                <ul class="list-group">
                    <?php
                        $bids = [
                            ['name' => 'Jaquline', 'bid' => 70, 'img' => '../assets/images/profile-jobboard.jpeg'],
                            ['name' => 'Yang', 'bid' => 60, 'img' => '../assets/images/profile2.jpeg'],
                            ['name' => 'Fung', 'bid' => 40, 'img' => '../assets/images/profile3.jpeg'],
                            ['name' => 'Zig', 'bid' => 50, 'img' => '../assets/images/profile4.jpeg'],
                        ];

                        foreach ($bids as $bidder) {
                            echo "
                            <li class='list-group-item d-flex align-items-center'>
                                <img src='{$bidder['img']}' class='rounded-circle me-3' alt='{$bidder['name']}' style='width: 60px; height: 60px; object-fit: cover;'>
                                <div class='flex-grow-1'>
                                    <h5 class='mb-1'>{$bidder['name']}</h5>
                                    <p class='mb-0'>Bid for RM{$bidder['bid']}</p>
                                </div>
                                <form action='accept_bid.php' method='POST' class='ms-3'>
                                    <input type='hidden' name='bidder' value='{$bidder['name']}'>
                                    <input type='hidden' name='bid_amount' value='{$bidder['bid']}'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Accept Bid</button>
                                </form>
                            </li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

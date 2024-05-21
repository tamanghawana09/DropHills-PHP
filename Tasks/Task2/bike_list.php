<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bikes</title>
    <link rel="stylesheet" href="/assets/css/bike_list.css">

</head>

<body>
    <div class="sidebar">
        <div class="container">
            <h2 class="text-center text-white">DropHills Bikes</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bike_list.php">Bike List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="message.php">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="nav-container">
            <nav>
                <h1>Bike List</h1>
            </nav>
        </div>
        <div class="content-container">
            <div class="card">
                <div class="card-body">
                    <div class="grid">
                        <?php
                            $selectsql = "SELECT * FROM bike_list";
                            $select_result = $conn->query($selectsql);
                            if($select_result->num_rows > 0){
                                while($rows = $select_result->fetch_assoc()){
                                    echo '<div class="item">';
                                    echo '<img src="uploads/' . $rows['image'] . '" alt="Bike Image">';
                                    echo '<div class="item-content">';
                                    echo '<h3>'.$rows['name'].'</h3>';
                                    echo '<h3>'.$rows['brand'].'</h3>';
                                    echo '<h3>'.$rows['cc'].'</h3>';
                                    echo '<h3>'.'Rs. '.$rows['price'].'</h3>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</html>
<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $deletesql = "DELETE FROM bike_list WHERE  id = $id";
    $delete_result = $conn->query($deletesql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bikes</title>
    <link rel="stylesheet" href="/assets/css/message.css">

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
                <h1>Message</h1>
            </nav>
        </div>
        <div class="content-container">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Message</th>
                            </tr>
                        </thead>
                        <?php

                        $selectsql = "SELECT * FROM message";
                        $select_result = $conn->query($selectsql);
                        if ($select_result->num_rows > 0) {
                            while ($rows = $select_result->fetch_assoc()) {
                                echo "<tbody>";
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($rows['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($rows['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($rows['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($rows['phone_number']) . "</td>";
                                echo "<td>" . htmlspecialchars($rows['message']) . "</td>";
                                echo "</tr>";
                                echo "</tbody>";
                            }
                        }
                        $conn->close();
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</html>
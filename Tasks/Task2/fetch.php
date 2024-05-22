<?php
include 'connect.php';

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = test_input($_POST['name']);
    $brand = test_input($_POST['brand']);
    $cc = test_input($_POST['cc']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bikes</title>
    <link rel="stylesheet" href="/assets/css/fetch.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="nav-container">
            <nav>
                <h1>Bike List</h1>
                <div class="search-bar">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <input type="text" placeholder="Search for bikes..." name="name">
                    <input type="text" placeholder="Search for brands..." name="brand">
                    <input type="text" placeholder="CC" name="cc">
                    <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </nav>
        </div>
        <div class="content-container">
            <div class="card">
                <div class="card-body">
                    <div class="grid">
                        <?php
                            $selectsql = "SELECT * FROM bike_list WHERE name = ? OR brand = ? OR cc = ?";
                            $stmt = $conn->prepare($selectsql);
                            $stmt->bind_param("sss", $name, $brand, $cc);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($rows = $result->fetch_assoc()) {
                                    echo '<div class="item">';
                                    echo '<img src="uploads/' . $rows['image'] . '" alt="Bike Image">';
                                    echo '<div class="item-content">';
                                    echo '<h3>' . $rows['name'] . '</h3>';
                                    echo '<h3>' . $rows['brand'] . '</h3>';
                                    echo '<h3>' . $rows['cc'] . '</h3>';
                                    echo '<h3>' . 'Rs. ' . $rows['price'] . '</h3>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }else{
                                echo "No data available";
                            }
                            $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
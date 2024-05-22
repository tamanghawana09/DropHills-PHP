<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
}

$id = $bike_image = $bike_name = $bike_brand = $bike_cc = $bike_price = "";
$nameErr = $brandErr = $ccErr = $priceErr = "";



$id = isset($_POST['id']) ? $_POST['id'] : "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $id) {
    $selectsql = "SELECT * from bike_list WHERE id =?";
    $stmt = $conn->prepare($selectsql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $select_result = $stmt->get_result();
    $rows = $select_result->fetch_assoc();
    $stmt->close();

    if ($rows) {
        $id = $rows['id'];
        $bike_image = $rows['image'];
        $bike_name = $rows['name'];
        $bike_brand = $rows['brand'];
        $bike_cc = $rows['cc'];
        $bike_price = $rows['price'];
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_new'])) {
    if (empty($_POST['name'])) {
        $nameErr = "Name is invalid";
    } else {
        $name = test_input($_POST['name']);
        if (!preg_match("/^[a-zA-Z0-9- ']*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST['brand'])) {
        $brandErr = "Brand name is invalid";
    } else {
        $brand = test_input($_POST['brand']);
        if (!preg_match("/^[a-zA-Z0-9- ']*$/", $brand)) {
            $brandErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST['cc'])) {
        $ccErr = "cc is invalid";
    } else {
        $cc = test_input($_POST['cc']);
        if (!preg_match("/^[a-zA-Z0-9- ']*$/", $cc)) {
            $ccErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST['price'])) {
        $priceErr = "price is invalid";
    } else {
        $price = test_input($_POST['price']);
    }
    if (empty($nameErr) && empty($brandErr) && empty($ccErr) && empty($priceErr)) {
        $id = $_POST['update_id'];
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $cc = $_POST['cc'];
        $price = $_POST['price'];

        if(!empty($_FILES["image"]["tmp_name"])){
            $filename = $_FILES['image']['name'];
            $targetDir = "uploads/";
            $targetFilePath = $targetDir .  $filename;
            if(move_uploaded_file($_FILES["image"]["tmp_name"],$targetFilePath)){
                $bike_image = $filename;
            }else{
                echo "error uploading file";
            }
        }else{
            $updatesql = "UPDATE bike_list SET image = '$bike_image',name ='$name', brand ='$brand', cc ='$cc', price = '$price' WHERE id = '$id'";
            $result = $conn->query($updatesql);
            if ($result) {
                echo '<script>alert("Successfully updated data")</script>';
                header("Location: dashboard.php");
                exit();
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bike</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Update Bike Details Form</h5>
            </div>
            <div class="card-body">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id: <?php echo htmlspecialchars($id) ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image : <?php echo $bike_image?></label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <span class="error" style="color:red;">* <?php echo $nameErr; ?></span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter bike name" value=" <?php echo htmlspecialchars($bike_name); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <span class="error" style="color:red;">* <?php echo $brandErr; ?></span>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter bike brand" value="<?php echo htmlspecialchars($bike_brand); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cc" class="form-label">CC</label>
                        <span class="error" style="color:red;">* <?php echo $ccErr; ?></span>
                        <input type="text" class="form-control" id="cc" name="cc" placeholder="Enter bike CC" value="<?php echo htmlspecialchars($bike_cc); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <span class="error" style="color:red;">* <?php echo $priceErr; ?></span>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Enter bike price" value="<?php echo htmlspecialchars($bike_price) ?>">
                    </div>
                    <input type="hidden" value="<?php echo $rows['id'] ?>" name="update_id">
                    <button type="submit" class="btn btn-success" name="update_new">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-HoAOMDmbz7jYvKsmH4zDmrD4l7d3GRZzJa8yW3sMr/TYxVSG5hpLTwBjD40zZe32" crossorigin="anonymous"></script>
</body>

</html>
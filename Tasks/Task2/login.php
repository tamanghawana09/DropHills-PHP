<?php
session_start();
include 'connect.php';

$email = $password =  $passwordHash = "";
$emailErr = $passwordErr = "";

//display error for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid EMAIL FORMAT";
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectsql = "SELECT email,password FROM users WHERE email = ?";
    $stmt = $conn->prepare($selectsql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password,$row['password'])){
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            header("Location: dashboard.php");
        }else{
            $passwordErr = "Wrong password provided";
        }
    }else{
        $emailErr = $_SESSION['email'] . " not found";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bike</title>
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <h2>Login Form</h2>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="email" name="email" placeholder="Enter email">
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="password" name="password" placeholder="Enter password">
            <span class="error">* <?php echo $passwordErr;?></span>
            <input type="submit" value="Submit" class="btn">
        </form>
        <div class="login">
            Don't have an account <a href="register.php">Register here!</a>
        </div>
    </div>
</body>

</html>
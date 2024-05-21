<?php
    include 'connect.php';


    $username = $email = $password = $repassword = "";
    $usernameErr = $emailErr = $passwordErr = $repasswordErr =  "";
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["username"])){
            $usernameErr = "Username is required";
        }else{
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9- ']*$/",$username)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
        if(empty($_POST["email"])){
            $emailErr = "Email is required";
        }else{
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid EMAIL FORMAT";
            }
        }
        if(empty($_POST["password"])){
            $passwordErr = "Password is required";
        }else{
            $password = test_input($_POST["password"]);
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);
        }
        if(empty($_POST["repassword"])){
            $repasswordErr = "Re-password is required";
        }else{
            $repassword = test_input($_POST["repassword"]);
            $repasswordhash = password_hash($repassword,PASSWORD_DEFAULT);
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if($password === $repassword){
            $sql = "INSERT INTO users(username,email,password,re_password) VALUES ('$username', '$email', '$passwordhash', '$repasswordhash')";
           if($conn->query($sql)){
            echo '<script>alert("Successfully Registered")</script>';
            header("Location: login.php");
            exit();
           }
        }else{
            $repasswordErr = "Password and Re-password doesn't match";
        }
    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropHills Bike</title>
    <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register Form</h2>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <input type="text" name="username" placeholder="Enter Username">
            <span class="error">* <?php echo $usernameErr;?></span>
            <input type="email" name="email" placeholder="Enter email">
            <span class="error">* <?php echo $emailErr;?></span>
            <input type="password" name="password" placeholder="Enter password">
            <span class="error">* <?php echo $passwordErr;?></span>
            <input type="password" name="repassword" placeholder="Re-enter password">
            <span class="error">* <?php echo $repasswordErr;?></span>
            <input type="submit" value="Submit" class="btn">
        </form>
        <div class="container">
            Already have an account <a href="login.php">Go back to login.</a>
        </div>
    </div>
</body>
</html>
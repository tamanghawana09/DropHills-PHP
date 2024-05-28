<?php
    include 'connect.php';


    class Register extends DatabaseConnection{
        private $username = "";
        private $email = "";
        private $password = "";
        private $repassword = "";

        public $usernameErr = "";
        public $nameErr = "";
        public $emailErr = "";
        public $passwordErr = "";
        public $repasswordErr = "";

        public function validation(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){

                if(empty($_POST["username"])){
                    $this->usernameErr = "Username is required";
                }else{
                    $this->username = $this->test_input($_POST["username"]);
                    if (!preg_match("/^[a-zA-Z0-9- ']*$/",$this->username)) {
                        $this->nameErr = "Only letters and white space allowed";
                    }
                }
        
                if(empty($_POST["email"])){
                    $this->emailErr = "Email is required";
                }else{
                    $this->email = $this->test_input($_POST["email"]);
                    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                        $this->emailErr = "Invalid email format";
                    }
                }
        
                if(empty($_POST["password"])){
                    $this->passwordErr = "Password is required";
                }else{
                    $this->password = $this->test_input($_POST["password"]);
                }
        
                if(empty($_POST["repassword"])){
                    $this->repasswordErr = "Re-password is required";
                }else{
                    $this->repassword = $this->test_input($_POST["repassword"]);
                }
            }
            $this->insertData();
        }


        public function insertData(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){

                if($this->password === $this->repassword){
                    $sql = "INSERT INTO users(username,email,password,re_password) VALUES ('$this->username', '$this->email', '$this->password', '$this->repassword')";
                   if($this->getConnection()->query($sql)){
                    echo '<script>alert("Successfully Registered")</script>';
                    header("Location: /");
                    exit();
                   }
                }else{
                    $this->repasswordErr = "Password and Re-password doesn't match";
                }
            }
        }

        
        private function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }



    $registerObj = new Register();
    $registerObj->validation();
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>
    <link rel="stylesheet" href="/css/register.css">
</head>
<body>
    <div class="container">
        <h2>REGISTER</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <input type="text" name="username" placeholder="Enter username">
            <span class="error">* <?php echo $registerObj->usernameErr;?></span>
            <input type="email" name="email" placeholder="Enter email">
            <span class="error">* <?php echo $registerObj->emailErr;?></span>
            <input type="password" name="password" placeholder="Enter password">
            <span class="error">* <?php echo $registerObj->passwordErr;?></span>
            <input type="password" name="repassword" placeholder="Re-enter password">
            <span class="error">* <?php echo $registerObj->repasswordErr;?></span>
            <input type="submit" value="Submit" class="btn">
        </form>
        <div class="register-container">
            Already have an account <a href="/">Go back to login.</a>
        </div>
    </div>
</body>
</html>


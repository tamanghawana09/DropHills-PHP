<?php
    session_start();
    include 'connect.php';


    class Index extends DatabaseConnection{
        private $email = "";
        private $password = "";
        public $emailErr = "";
        public $passwordErr = "";

        public function validation(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(isset($_POST["email"])){
                    if(empty($_POST["email"])){
                        $this->emailErr = "Email is required";
                    }else{
                        $this->email = $this->test_input($_POST["email"]);
                        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                            $this->emailErr = "Invalid email format";
                        }
                    }
                }
               if(isset($_POST["password"])){
                    if(empty($_POST["password"])){
                        $this->passwordErr = "Password is required";
                    }else{
                        $this->password = $this->test_input($_POST["password"]);
                    }
               }
            }
            $this->insertData();
        }

        public function insertData(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $selectsql = "SELECT email,password FROM users WHERE email = ?";
                $stmt = $this->conn->prepare($selectsql);
                $stmt->bind_param('s',$this->email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if($result->num_rows > 0){
                    $rows = $result->fetch_assoc();
                    if($rows['password'] === $this->password){
                            $_SESSION["email"] = $this->email;
                            $_SESSION["loggedin"] = true;
                            header("Location: dashboard.php");
                        }else{
                            $this->passwordErr = "Wrong password provided";
                    }   
                }else{
                    $this->emailErr = "Email not found";
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
    $obj = new Index();
    $obj->validation();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="container">
        <h2>LOGIN</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <input type="email" name="email" placeholder="Enter email">
            <span class="error">* <?php echo $obj->emailErr;?></span>
            <input type="password" name="password" placeholder="Enter password">
            <span class="error">* <?php echo $obj->passwordErr;?></span>
            <input type="submit" value="Submit" class="btn">
        </form>
        <div class="register-container">
            Don't have an account yet ? <a href="register.php">Register here.</a>
        </div>
    </div>
</body>
</html>
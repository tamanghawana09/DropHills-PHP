<?php
session_start();
include 'connect.php';


class InsertData extends DatabaseConnection{
    private $fname = "";
    private $mname = "";
    private $lname = "";
    private $email = "";
    private $number = "";
    public $fnameErr = "";
    public $mnameErr = "";
    public $lnameErr = "";
    public $emailErr = "";
    public $numberErr = "";
    public $passwordErr = "";
  


    public function __construct(){
        parent::__construct();
        if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            header("Location: /");
            exit();
        }
    }

    public function validation(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
                $this->fnameErr = "First name is required";
            } else {
                $this->fname = $this->test_input($_POST["fname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $this->fname)) {
                    $this->fnameErr = "Only letters and white space allowed";
                }
            }
            $this->mname = $this->test_input($_POST["mname"]);
            if (empty($_POST["lname"])) {
                $this->lnameErr = "Last name is required";
            } else {
                $this->lname = $this->test_input($_POST["lname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $this->lname)) {
                    $this->lnameErr = "Only letters and white space allowed";
                }
            }
            if (empty($_POST["email"])) {
                $this->emailErr = "Email is required";
            } else {
                $this->email = $this->test_input($_POST["email"]);
                if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                    $this->emailErr = "Invalid email format";
                }
            }
            if (empty($_POST['number'])) {
                $this->numberErr = "Phone number is required";
            } else {
                $this->number = $this->test_input($_POST['number']);
                if (!preg_match("/^[0-9 ]*$/", $this->number)) {
                    $this->numberErr = "Only numbers allowed";
                }
            }
        }

        $this->insertData();
    }

    public function insertData(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            $selectsql = "SELECT phone_number from contacts";
            $select_result = $this->getConnection()->query($selectsql);
            if ($select_result->num_rows > 0) {
                while ($rows = $select_result->fetch_assoc()) {
                    if ($rows['phone_number'] == $this->number) {
                        $numberErr = "Phone number already exists";
                    }
                }
            }
        
            if (empty($this->emailErr) && empty($this->numberErr)) {
                $insertsql = "INSERT INTO contacts (first_name,middle_name,last_name,email,phone_number) VALUES ('$this->fname','$this->mname','$this->lname','$this->email','$this->number')";
                $result = $this->getConnection()->query($insertsql);
                if ($result) {
                    header("Location: dashboard.php");
                    exit();
                }
            }
        }
        
        $this->getConnection()->close();
    }

    private function test_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



}

$insertData = new InsertData();
$insertData->validation();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="background-color: #D9CBA4;">
    <div class="card m-2">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <h2>Insert a record </h2>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <span class="error" style="color:red;">* <?php echo $insertData->fnameErr; ?></span>
                    <input type="txt" class="form-control" name="fname">
                </div>
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <span class="error" style="color:red;">* <?php echo $insertData->mnameErr; ?></span>
                    <input type="txt" class="form-control" name="mname">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <span class="error" style="color:red;">* <?php echo $insertData->lnameErr; ?></span>
                    <input type="txt" class="form-control" name="lname">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <span class="error" style="color:red;">* <?php echo $insertData->emailErr; ?></span>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Phone Number</label>
                    <span class="error" style="color:red;">* <?php echo $insertData->numberErr; ?></span>
                    <input type="txt" class="form-control" name="number">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
session_start();
include 'connect.php';

class Update extends DatabaseConnection{
    public $id="";
    private $new_id ="";

    public $fname = "";
    public $lname = "";
    public $mname = "";
    protected $email = "";
    protected $number = "";
    public $fnameErr ="";
    public $mnameErr ="";
    public $lnameErr ="";
    public $emailErr ="";
    public $numberErr ="";
    public $passwordErr ="";

    public function getEmail(){
        return $this->email;
    }
    public function getNumber(){
        return $this->number;
    }

    public function __construct(){
        parent::__construct();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
            header("Location: /");
            exit();
        }
    }

    public function fetchData(){
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        if ($id) {
            $selectsql = "SELECT * FROM contacts WHERE id=?";
            $stmt = $this->getConnection()->prepare($selectsql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $select_result = $stmt->get_result();
            $rows = $select_result->fetch_assoc();
            $stmt->close();
        
            // Initialize form variables with fetched data
            if ($rows) {
                $this->id = $rows['id'];
                $this->fname = $rows['first_name'];
                $this->mname = $rows['middle_name'];
                $this->lname = $rows['last_name'];
                $this->email = $rows['email'];
                $this->number = $rows['phone_number'];
            }
        }

    }

    public function updateData(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_new'])) {
            if (empty($_POST["fname"])) {
                $this->fnameErr = "First name is required";
            } else {
                $this->fname = $this->test_input($_POST["fname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $this->fname)) {
                    $this->fnameErr = "Only letters and white space allowed";
                }
            }
        
            if (isset($_POST["mname"])) {
                $this->mname = $this->test_input($_POST["mname"]);
                if (!preg_match("/^[a-zA-Z-' ]*$/", $this->mname)) {
                    $this->mnameErr = "Only letters and white space allowed";
                }
            }
        
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
                } else {
                    $selectsql = "SELECT * from contacts";
                    $select_result = $this->getConnection()->query($selectsql);
                    if ($select_result->num_rows > 0) {
                        while ($rows = $select_result->fetch_assoc()) {
                            if ($rows['phone_number'] == $this->number && $rows['first_name'] == $this->fname && $rows['last_name'] == $this->lname && $rows['middle_name'] == $this->mname) {
                                $this->numberErr = "Phone number already exists";
                            }
                            
                        }
                    }
                }
            }
        
            if (empty($this->fnameErr) && empty($this->lnameErr) && empty($this->mnameErr) && empty($this->emailErr) &&empty($this->numberErr)) {
                $this->new_id = $_POST['update_id'];
                $updatesql = "UPDATE contacts SET first_name=?, middle_name=?, last_name=?, email=?, phone_number=? WHERE id=?";
                $stmt = $this->getConnection()->prepare($updatesql);
                $stmt->bind_param("sssssi", $this->fname, $this->mname, $this->lname, $this->email, $this->number, $this->new_id);
                if ($stmt->execute()) {
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            }
        }
        $this->getConnection()->close();
    
    }

    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$updateObj = new Update();
$updateObj->fetchData();

if(isset($_POST['update_new'])){
    $updateObj->updateData();
}


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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Update the record</h2>
                <div class="mb-3">
                    <label for="id">Id: "<?php echo $updateObj->id; ?>"</label>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <span class="error" style="color:red;">* <?php echo $updateObj->fnameErr; ?></span>
                    <input type="text" class="form-control" name="fname" value="<?php echo htmlspecialchars($updateObj->fname); ?>">
                </div>
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <span class="error" style="color:red;"> <?php echo $updateObj->mnameErr; ?></span>
                    <input type="text" class="form-control" name="mname" value="<?php echo htmlspecialchars($updateObj->mname); ?>">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <span class="error" style="color:red;">* <?php echo $updateObj->lnameErr; ?></span>
                    <input type="text" class="form-control" name="lname" value="<?php echo htmlspecialchars($updateObj->lname); ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <span class="error" style="color:red;">* <?php echo $updateObj->emailErr; ?></span>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($updateObj->getEmail()); ?>">
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Phone Number</label>
                    <span class="error" style="color:red;">* <?php echo $updateObj->numberErr; ?></span>
                    <input type="text" class="form-control" name="number" value="<?php echo htmlspecialchars($updateObj->getNumber()); ?>">
                </div>
                <input type="hidden" value="<?php echo isset($updateObj->id) ? $updateObj->id : ''; ?>" name="update_id">
                <button type="submit" class="btn btn-success" name="update_new">Submit</button>
                <a href="dashboard.php" type="button" class="btn btn-warning">Back</a>
            </form>
            
        </div>
    </div>
</body>
</html>
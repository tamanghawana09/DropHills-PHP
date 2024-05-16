<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    
    <?php
        //variable defination and set to empty values
        $name = $email = $website = $comment = $gender = "";
        $nameERR = $emailERR = $websiteERR = $genderERR = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST["name"])){
                $nameERR = "Name is required";
            }else{
                $name = test_input($_POST["name"]);
                if(!preg_match("/^[a-z A-Z -']*$/",$name)){
                    $nameERR = "Only letters and hyphens are allowed";
                }
            }
            if(empty($_POST["email"])){
                $emailERR = "Email is required";
            }else{
                $email = test_input($_POST["email"]);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailERR = "Invalid email format";
                }
            }
            if(empty($_POST["website"])){
                $website = "";
            }else{
                $website = test_input($_POST["website"]);
                if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                    $websiteERR = "Invalid URL";
                }
            }
            if(empty($_POST["comment"])){
                $comment = "";
            }else{
                $comment = test_input($_POST["comment"]);
            }
            if(empty($_POST["gender"])){
                $genderERR = "Gender is required";
            }else{
                $gender = test_input($_POST["gender"]);
            }
        }

        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function linebreak(){
            echo "<br>";
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        Name: <input type="text" placeholder="Enter name" name="name" value="<?php echo htmlspecialchars($name)?>">
                <span class="error">* <?php echo $nameERR;?></span><br><br>
        Email: <input type="text" placeholder="Enter email" name="email" value="<?php echo htmlspecialchars( $email)?>">
                <span class="error">* <?php echo $emailERR;?></span><br><br>
        Website: <input type="text" placeholder="Enter website" name="website" value="<?php echo htmlspecialchars($website)?>"><br><br>
        Comment: <textarea name="comment" id="comment" value="<?php  echo htmlspecialchars($comment)?>"></textarea><br><br>
        <label for="gender">Gender :</label>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="female" >Female
        <input type="radio" name="gender" for="other" value="other">Other
        <span class="error">* <?php echo $genderERR;?></span><br><br>
        <input type="submit" value="Submit">
    </form> 

    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        echo "<h2> Your input </h2>";
        echo $name; linebreak();
        echo $email; linebreak();
        echo $website; linebreak();
        echo $comment; linebreak();
        echo $gender; linebreak();
    }
    ?>
</body>
</html>
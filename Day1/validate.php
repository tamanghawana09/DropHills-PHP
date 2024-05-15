<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php 
    echo htmlspecialchars($_SERVER['PHP_SELF'])    
    ?>" method="POST">

        Email:<input type="text" placeholder="email" name="email" id="email">
        <input type="submit">
    </form>

    <?php
        $emailERR = "";
        $email =test_input($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailERR = "Invalid email format";
            echo $emailERR;
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
    ?>
</body>
</html>
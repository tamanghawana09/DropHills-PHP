<?php
include 'connect.php';

$name = $email = $number = $message = "";

if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $message = $_POST['message'];

    $insertsql = "INSERT INTO message(name,email,phone_number,message) VALUES('$name','$email','$number','$message')";
    $result = $conn->query($insertsql);
    if ($result) {
        echo "<script>alert('Message sent')</script>";
        header('Location: /');
        exit();
    }
}

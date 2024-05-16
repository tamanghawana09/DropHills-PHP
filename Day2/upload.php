<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //check if the image file is a actual image or fake image
    if(isset($_POST["submit"])){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false){
            echo "File is an image - " . $check["mime"]. ".";
            $uploadOk = 1;
        }else{
            echo "File is not an image";
            $uploadOk =0;
        }

        if(file_exists($target_file)){
            echo "<br>";
            echo "Sorry, file already exists";
            $uploadOk = 0;
        }
    }

    if($uploadOk == 1){
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<br>";
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded";
        }else{
            echo "Error uploading the file";
        }
    }

?>
<?php
    $file = fopen("file.txt","r") or die("Unable to open file");
    # echo fread($file,filesize("file.txt"));

    //output one line until the end of line
    while(!feof($file)){
        //read single line - fgets()
        #echo fgets($file) . "<br>";

        //read single character - fgetc()
        echo fgetc($file);
    }
    fclose($file);
?>
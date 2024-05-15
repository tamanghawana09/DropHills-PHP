<?php
    $favcolor = "red";
    switch($favcolor){
        case "red":
            echo "Your favorite color is red";
            break;
        case "blue":
            echo "Your favorite color is blue";
            break;
        case "green":
            echo "Your favorite color is green";
            break;
        default:
            echo "Your favorite color is neither red, blue, nor green!";
    }

    $colors = array("red","green","blue","yellow");
    foreach($colors as $x){
        echo "<br> $x <br>";
    }
    

    //associative array
    $members = array("Peter"=>"35", "Ben"=>"30", "Joe"=>"20");

    foreach($members as $x =>$y){
        echo "$x : $y <br>";
    }
?>
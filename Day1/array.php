<?php
    function myFunction(){
        echo "hey hawana here working in drophills";
    }
    $myArr = array("Volvo",15,["apples","bananas"],"message"=>"myFunction");
    #array_push($myArr,myFunction());
    $myArr["message"]();
    
    echo "<br>";
    #PHP Associative Arrays
    $car = array("brand"=>"Ford","model"=>"Mustang","year"=>1914);
    $car["color"] = "Red";
    var_dump($car);
    echo "<br>";
    print_r($car);
    echo "<br>";

    echo " The model of the car is :" .$car["model"]."<br>";

    foreach($car as $x => $y){
        echo "$x : $y <br>";
    }

?>
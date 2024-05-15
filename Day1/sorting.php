<?php
    $cars = array("Volvo", "BMW", "Toyota");
    #sort($cars);       //ascending order
    rsort($cars);
    

    $numbers = array(4,6,2,22,11);
    #sort($numbers);        //ascending order
    rsort($numbers);

    print_r($cars);
    echo "<br>";
    print_r($numbers);


    $age = array("Peter" => "5", "Ben" => "37", "Joe"=>"43");
    #asort($age);  //ascending sort according to the value 
    #ksort($age);    //ascending sort according to the key
    #arsort($age);  //descending sort according to the value
    krsort($age); //descending sort according to the key
    echo "<br>";
    print_r($age);
?>
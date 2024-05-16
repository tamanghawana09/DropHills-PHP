<?php

    //encode associative array into a json object
    $age = array("Peter" =>35, "Ben"=>37, "Joe"=>43);
    echo json_encode($age);

    echo "<br>";

    //encode indexed array into  a json array
    $cars = array("Volvo", "BMW", "Toyota");
    echo json_encode($cars);
    echo "<br>";

    //decode json into php object

    $jsonobj = '{"Peter":35, "Ben":37, "Joe":43}';


    //when the second parameter is set to true, JSON objects are decoded into associative arrays.
    var_dump(json_decode($jsonobj,true));
?>
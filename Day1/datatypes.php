<?php
    #PHP String

    //can use single quote or double quote
    $x = "Hello World !";
    $txt = "Hello World !";
    echo "The word count are : " .str_word_count($x);
    line_break();
    var_dump($x);
    line_break();

    $a = 10.345;
    var_dump($a);
    line_break();

    $a = true;
    var_dump($a);
    line_break();
    
    $cars = array("Volvo", "RR", "BMW", "Toyota");
    var_dump($cars);
    line_break();

    $x = null; //variable emptied
    var_dump($x);
    line_break();

    //casting the variable
    $x = (int) "10";
    var_dump($x);
    line_break();

    echo str_replace("World", "hawana", $txt); //string replace
    line_break();

    $txt_result = explode(" ", $txt); //changing from string to array
    print_r($txt_result);
    line_break();

    //cast float to int
    $num = 23.455;
    $int_cast = (int) $num;
    echo $int_cast;
    line_break();

    //cast string to int
    $num = "23.434";
    $int_cast = (int) $num;
    echo $int_cast;
    line_break();

    function line_break(){
        echo "<br>";
    }
?>
<?php
    //value of pi
    echo (pi());
    line_break();
    //min & max
    echo(min(0,150,3,20,-8,-200));
    line_break();

    echo(max(0,150,30,20,-8,-200));
    line_break();

    echo(abs(-6.7)); //absolute value
    line_break();

    echo(sqrt(64));
    line_break();

    echo(rand(10,100)); //generates random integer between 10 and 100(inclusive)
    line_break();

    define("GREETINGS", "Welcome to drophills");
    echo GREETINGS;
    line_break();

    #PHP Constant Arrays

    define("cars",[
        "Alfa Romeo",
        "BMW",
        "Toyota"
    ]);
    echo cars[0];


    function line_break(){
        echo "<br>";
    }
?>
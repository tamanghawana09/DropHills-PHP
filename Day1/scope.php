<?php
    $x =5 ; //global scope

    function hey(){
        //global scope can't be used inside this function scope


        $x = 10; //local variable
        echo "<p?> The value of x is $x </p>";
    }
    hey();

    //the local variable can't be used outside the scope
    echo "<p> Value of x outside function is : $x</p>";


    //global keyword
    $a =2;
    $b =2;
    
    function global_scope(){
       global $a, $b, $result;
       
       $result = $a + $b;
       
    }

    global_scope();
    echo "<p> The value of result is $result </p>";


    // The GLOBAL array i.e $GLOBALS[index]
    function new_global_func(){
        $GLOBALS['a'] = $GLOBALS['a'] + $GLOBALS['b'];
    }
    new_global_func();
    echo "The new value of a using the new_global_func  is $a";
    echo "<br>";


    // The static keyword
    function static_func(){
        static $x =0;
        echo "$x";
        $x++;
    }
    
    static_func();
    static_func();
    static_func();


    //use of print statement
    print "<h2> PHP is fun! </h2>";
    print "Hey Hawana here! <br>";
    print "I'm about to learn PHP!";
?>
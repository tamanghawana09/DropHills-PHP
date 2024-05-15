<?php
    $str = "Visit W3Schools";
    $pattern = "/w3schools/i";
    echo preg_match($pattern,$str);
    echo "<br>";

    $strnew = "The rain in SPAIN falls mainly on the plains.";
    $patternnew = "/ain/i"; 
    echo preg_match_all($patternnew,$strnew);
    echo "<br>";

    $str_NEW = "Visit Microsoft!";
    $pattern_NEW = "/microsoft/i";
    echo preg_replace($pattern_NEW, "W3Schools",$str_NEW);
?>
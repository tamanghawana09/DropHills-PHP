<?php

//writing in file

$file = fopen("hawana.txt","a") or die ("Unable to open file!");
$txt = "learning php \n";
fwrite($file,$txt);
$txt = "New to php \n";
fwrite($file,$txt);
readfile("hawana.txt");
fclose($file);
?>
<?php
$cities = array("India"=>"Delhi","United States"=>"Washington","United Kingdom"=>"London");

//create an ArrayIterator Object
$iterator = new ArrayIterator($cities);


//rewind to beginning of array
$iterator->rewind();

while($iterator->valid()){
    echo $iterator->current(). " is in " . $iterator->key()." ";
    echo "<br>";
    $iterator->next();
}
<?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("m.d.Y") . "<br>";
echo "Today is " . date("l") . "<br>";  //represents the day of the week
date_default_timezone_set("America/New_York");
echo "The time is " . date("h:i:sa");
echo "<br>";
$d = mktime(11, 14, 54, 8, 12, 2014);
echo "Created date is " . date("Y-m-d h:i:sa", $d);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <footer>
        <!-- copyright -->
        &copy; 2010-<?php echo date("Y"); ?>, All rights reserved.
    </footer>
</body>

</html>
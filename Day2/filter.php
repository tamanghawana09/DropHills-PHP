<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Filter Name</td>
            <td>Filter ID</td>
        </tr>
        <?php
            foreach (filter_list() as $id => $filter){
                echo '<tr><td>' . $filter .'</td><td>' . filter_id($filter) . '</td></tr>';
            }

            //validate an IP address
            $ip = '127.0.0.1';
            if(!filter_var($ip, FILTER_VALIDATE_IP) === false){
                echo "$ip is a valid IP address";
            }else{
                echo "$ip is not a valid IP address";
            }
        ?>
    </table>
</body>
</html>
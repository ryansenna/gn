<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Event calendar</title>
    <style>
        table {border-collapse:collapse; table-layout:fixed; width:600px;}
        table td {border:solid 1px #fab; width:100px; height:100px; word-wrap:break-word;}
        table th {border:solid 2px #fab; width:100px; word-wrap:break-word;}
    </style>
</head>

<body>
<h1>September 2016</h1>
<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 9/8/2016
 * Time: 11:01 AM
 */

$handle = fopen("/home/vagrant/Code/Projects/labs/lab2/events.txt", "r");

//Read through File
$ctr = 0;
$firstDay = 0;
while (($buffer = fgets($handle)) !== false) {

    if($ctr === 0) {
        $firstDay = date('N',strtotime($buffer));// this gets the first day in september, so Thursday.
        $totalDays = date('t',strtotime($buffer));// this gets the total number of days in this month.
    }
    else{
        $events = array();
        $events[$ctr] = $buffer;
        echo "<br>";
    }
    $ctr++;
}
if (!feof($handle)) {
    echo "Error: fgets fail";
}
fclose($handle);

echo "<table> <tr> ";
echo "<th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th>";
echo "<th>Friday</th><th>Saturday</th></tr>";

$days = 1;
$qtyOfWeeks = 5;
if($firstDay <= 4 && $totalDays >= 29) {
    $qtyOfWeeks = 5;
}
elseif($firstDay == 6 && $totalDays == 30) {
    $qtyOfWeeks = 6;
}
elseif($firstDay == 0 && $totalDays == 28) {
    $qtyOfWeeks = 4;
}
elseif($firstDay >=5 && $totalDays == 31 ){
    $qtyOfWeeks = 6;
}
var_dump($qtyOfWeeks, $firstDay, $totalDays);
for($i =0; $i < $qtyOfWeeks;$i++)
{
    echo "<tr>";
    for($j =0; $j < 7; $j++) {
        if ($j < $firstDay && $i === 0) {
            echo "<td> </td>";

        }
        elseif($i === $qtyOfWeeks-1)
        {
            echo"<td>$totalDays</td>";
            break;
        }
        else {
            echo "<td>$days</td>";
            $days++;
        }

    }
    echo "</tr>";
}


?>
</body>
</html>

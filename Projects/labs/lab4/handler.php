<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 9/12/2016
 * Time: 2:35 PM
 */

// check if all data entered is correct.
$fName ="hello";
if(!empty($_POST['fName']))
    $fName = strip_tags($_POST['fName']);
else
    echo " first name box is empty!<br>";
if(!empty($_POST['lName']))
    $lName = strip_tags($_POST['lName']);
else
    echo "last name box is empty!<br>";

include 'index.php';

//$countries = array();
//$second_handler = fopen("/home/vagrant/Code/Projects/labs/lab3/Countries.txt", "r");
//while(($buffer = fgets($second_handler)) !== false)
//{
//    array_push($countries, $buffer);
//}
echo array_diff($interests, $_POST['interests']);
foreach($countries as $value)
{
    if(!in_array($value, $_POST['countryList']))
        echo "It is not in hte array! $value";
}


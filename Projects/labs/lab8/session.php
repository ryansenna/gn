<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 10/31/2016
 * Time: 1:48 PM
 */
session_start();
session_regenerate_id();
if(isset($_SESSION['count']))
{

    //update the counter;
    $counter = $_SESSION['count'];
    $counter++;
    $_SESSION['count'] = $counter;
    date_default_timezone_set('America/Montreal');
    $_SESSION['lastVisit'] = date('D M d H:i:s e Y');
}
else{
    //create count
    $_SESSION['count'] = 1;
    // create session id
    $_SESSION['id'] = session_id();
    //set date
    date_default_timezone_set('America/Montreal');
    $_SESSION['creationTime'] = date('D M d H:i:s e Y');
    $_SESSION['lastVisit'] = $_SESSION['creationTime'];
}

// put the id into the view.
echo "Session Id: ".$_SESSION['id']."<br>";
// put creation time to the view
echo "First Visit: ".$_SESSION['creationTime']."<br>";
echo "Last Visit: ".$_SESSION['lastVisit']."<br>";
// put the counter to the view
echo "Counter: ".$_SESSION['count']."<br>";

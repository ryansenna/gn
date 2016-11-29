<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 10/31/2016
 * Time: 1:21 PM
 */

echo "<html>";
echo "<head>";
echo "</head>";
echo "<body>";
echo "<h1>Welcome new Visitor!</h1>";
setcookie('name', 'Jaya');
setcookie('lang', 'en');
setcookie('hobby', 'sleep');
echo "<a href='session.php'>Show Cookies</a>";
echo "</body>";
echo "</html>";
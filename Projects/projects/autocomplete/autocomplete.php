<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/9/2016
 * Time: 10:18 AM
 */
session_start();
session_regenerate_id();

function areSessionsSet()
{// verifies if the sessions variables where set.

    if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
        return false;
    }
    if (!isset($_SESSION["pass"]) || empty($_SESSION["pass"])) {
        return false;
    }

    return true;
}

function getUserName()
{
    $u = new DAO();
    $email = trim(strip_tags($_SESSION["email"]));
    return $u->getUserNameFromDB($email);
}

?>

<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/ajax-search.js"></script>

    <title>Search - Autocomplete</title>
</head>
<body id='body'>
<div class="jumbotron text-center alert alert-info">
    <h1>Hello <?php require 'DAO.php';
        echo getUserName(); ?>, </h1>
    <h3> type your search bellow </h3>
</div>
<div class="container" id="form">
    <form action="search_handler.php" method="post">
        <div class="form-group" id="emailBox">
            <label for="search">Search:</label>
            <input type="text" name="search" class="form-control" list="belowBox" id="searchBar"
                   placeholder="Search Here" autocomplete="off">
            <datalist id="belowBox"></datalist>
        </div>
    </form>
</div>
<div class="container center_btns">
    <a href="index.php" class="btn btn-primary btn-default"><span class="glyphicon glyphicon-log-out"></span> Log
        out</a>
</div>
<div class="container" id="output">
    <?php
    if (areSessionsSet()) {
        if (isset($_SESSION["terms"])) {
            $terms = $_SESSION["terms"];
            foreach ($terms as $term) {
                echo "<h3> $term</h3><br>";
            }
        }
    } else {
        header('Location: index.php');
    } ?>
</div>
</body>
</html>



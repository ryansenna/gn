<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/11/2016
 * Time: 5:28 PM
 */
require 'DAO.php';
session_start(); // have a handle on the session variables
session_regenerate_id();

function isSearchFieldsSet()
{
    if(!isset($_POST["search"]) || empty($_POST["search"])){
        return false;
    }
    return true;
}

if(isSearchFieldsSet()){
    $u = new DAO();
    $term = trim(strip_tags($_POST["search"]));
    $isInserted = $u->insertTermToHistory($term);

    if($isInserted)
    {
        $s = new DAO();
        $_SESSION["successMsg"] = true;
        $userId = $s->getUserIdFromDB($_SESSION["email"]);
        $_SESSION["terms"] = $s->getTermsByUserId($userId);
        //var_dump($_SESSION["terms"]);
        header('Location: autocomplete.php');// go to the autocomplete page.
    }
    else{
        $_SESSION["successMsg"] = false;
        header('Location: autocomplete.php');// go to the autocomplete page.
    }

}
else{
    $_SESSION["successMsg"] = false;
    header('Location: autocomplete.php');// go to the autocomplete page.
}
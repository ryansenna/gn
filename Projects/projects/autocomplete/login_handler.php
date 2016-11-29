<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/7/2016
 * Time: 2:03 PM
 */
require 'DAO.php';
//submition
function areAllFieldsSet()
{
    if(!isset($_POST["lEmail"]) || empty($_POST["lEmail"])){
        return false;
    }

    if(!isset($_POST["lPass"]) || empty($_POST["lPass"])){
        return false;
    }

    return true;
}

function areSessionsSet(){// verifies if the sessions variables where set.

    session_start();
    session_regenerate_id();
    if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
        return false;
    }
    if(!isset($_SESSION["pass"]) || empty($_SESSION["pass"])){
        return false;
    }

    return true;
}

// if the session was already set, meaning from the registration page or whatsoever then login automatically.
if(areSessionsSet()){
    header('Location: autocomplete.php');// go to the autocomplete page.
} elseif(areAllFieldsSet()){// if the session was not set meaning it came from the login page and not the register_handler.
    $email = strip_tags($_POST["lEmail"]);// get the email from the email field.
    $pass = strip_tags($_POST["lPass"]);// get the pass from the password field.
    $uDAO = new DAO();// instantiate a new Data Access Object.

    //if this email address is in Db, meaning that the user was properly registered.
    if($uDAO->isEmailAddressInDB($email)){

        // get its hash password from the DB
        $dbPass = $uDAO->getPasswordFromDB($email);
        // compare with what he has entered
        if($uDAO->comparePasswords($pass,$dbPass)){// if it is true, log the person in
            session_start();//start a session here.
            session_regenerate_id();
            $_SESSION["email"] = $email;
            $_SESSION["pass"]= $pass;
            header('Location: autocomplete.php');// go to the autocomplete page.
        }
        else{// if it the password comparation fails, go back to the login page.
            echo "hello";
            header('Location: index.php');
        }
    }
    else{// if it cant find an email registered, then go back to the login page.
        echo "hello";
        header('Location: index.php');
    }
}else{// if all fields are not properly set, go back to the login page.
    echo "hello";
    header('Location: index.php');
}

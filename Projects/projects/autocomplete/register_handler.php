<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/7/2016
 * Time: 2:29 PM
 */
//submition
session_start();
session_regenerate_id();
require 'User.php';
function areAllFieldsSetForRegister()
{

    if (!isset($_POST['rfName']) || empty($_POST['rfName'])) {
        return false;
    }
    if (!isset($_POST['rlName']) || empty($_POST['rlName'])) {
        return false;
    }
    if (!isset($_POST['remailAddress']) || empty($_POST['remailAddress'])) {
        return false;
    }
    if (!isset($_POST['rpass']) || empty($_POST['rpass'])) {
        return false;
    }
    if (!isset($_POST['rpassAgain']) || empty($_POST['rpassAgain'])) {
        return false;
    }
    return true;
}


if (areAllFieldsSetForRegister()) {
    $dao = new DAO();
    if ($_POST['rpass'] != $_POST['rpassAgain'] || $dao->isEmailAddressInDB($_POST['remailAddress'])) {
        header('Location: register.php');
    }
    else {
        $u = new User();
        $u->setEmailAddr(strip_tags($_POST['remailAddress']));
        $u->setFname(strip_tags($_POST['rfName']));
        $u->setLname(strip_tags($_POST['rlName']));
        $u->setPass(strip_tags($_POST['rpass']));

        $u->loadToDatabase();
        //initialize a session

        $_SESSION["email"] = $u->getEmailAddr();
        $_SESSION["pass"] = $u->getPass();
        header('Location: login_handler.php');
    }
} else {
    header('Location: register.php');
}


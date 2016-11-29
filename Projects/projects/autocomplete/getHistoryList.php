<?php
/**
 * this script will get the history from a user
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/11/2016
 * Time: 6:56 PM
 */

header('content-type:application/json');
require 'DAO.php';
$s = new DAO();
session_start();
session_regenerate_id();
$userId = $s->getUserIdFromDB($_SESSION["email"]);
$cities = $s->getTermsByUserId($userId);
echo json_encode($cities);
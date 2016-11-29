<?php
/**
 * Created by PhpStorm.
 * User: 1333612
 * Date: 11/10/2016
 * Time: 5:50 PM
 */
require 'DAO.php';
$item = $_POST['search'];
$c = new DAO();
$a = $c->search($item);
var_dump($a);
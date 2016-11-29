<?php
/**
 *
 * This php script is responsible for handling the ajax requests.
 * So it will use the DAO class to search for the items,
 * encode and return the list as JSON.
 *
 * Created by PhpStorm.
 * @author Railanderson Sena
 * Date: 11/9/2016
 */


header('content-type:application/json');
require 'DAO.php';
$term = trim(strip_tags($_GET['mySearch']));
$s = new DAO();
$cities = $s->search($term);
echo json_encode($cities);
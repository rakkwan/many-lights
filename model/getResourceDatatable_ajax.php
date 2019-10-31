<?php

/**
 * Robert Hill
 *
 */

require_once ('database.php');
//get the POST var
if ( !empty($_POST) ) {
    $status = $_POST['statusID'];
}
else {
    $status = 1;
}

//var_dump($status);

//access DB
$db = new Databases();

//get the pending resources
$td = $db->getOneResWithKeyInfo($status);

//array to hold the results
$holdArr = [];

//return the results
echo json_encode($td);
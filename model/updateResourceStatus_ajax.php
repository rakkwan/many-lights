<?php

/**
 * Robert Hill
 *
 */

require_once ('database.php');
//get the POST var
if ( !empty($_POST) ) {
    $resourceID = $_POST['statusID'];
    $choice = $_POST['choice'];
}
else {
    $statusID = 1;
}

//var_dump($status);

//access DB
$db = new Databases();

//get the pending resources
$td = $db->updateStatus($resourceID, $choice);

//return the results
echo json_encode($td);
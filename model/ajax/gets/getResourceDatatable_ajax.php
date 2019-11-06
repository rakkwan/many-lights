<?php

/**
 * Robert Hill
 * 11/1/19
 * This is a select php ajax script to return resource info from the DB
 */

require_once ('../../database.php');
//get the POST array variable from call
if ( !empty($_POST) ) {
    $status = $_POST['statusID'];
}
else {
    $status = 1;
}

//instantiate DB
$db = new Databases();

//return the results from the DB
echo json_encode($db->getSelectedListInfo($status));

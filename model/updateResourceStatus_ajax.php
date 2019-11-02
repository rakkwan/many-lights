<?php

/**
 * Robert Hill
 *
 */

require_once ('database.php');
//get the POST var
if ( !empty($_POST) ) {
    $resourceID = $_POST["statusID"];
    $choice = $_POST["choice"];

//access DB
    $db = new Databases();

//return Resource and choice to change status
    echo json_encode($db->updateStatus($resourceID, $choice));
}
else {
    echo "Not updated";
}
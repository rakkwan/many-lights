<?php
/**
 * Created by PhpStorm.
 * User: samantha
 * Date: 2019-11-12
 * Time: 21:51
 */

require_once('../../database.php');
//get the POST array variable from call
if (!empty($_POST)) {
    $status = $_POST['statusID'];
} else {
    $status = 1;
}

//instantiate DB
$db = new Databases();

//return the results from the DB
echo json_encode($db->getSelectedListInfo($status));

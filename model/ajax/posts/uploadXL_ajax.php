<?php session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

/**
 * Robert Hill
 * 11/24/19
 * uploadXL_ajax.php
 *
 * Is an endpoint script
 * for admin user to
 * upload an XLXS file of resources
 * to the DB.
 */
require_once('../../../model/database.php');
require_once ('../../../classes/SimpleXLSX.php');

/**
 * @param array $rows
 * @param Databases $db
 * @param int $id
 * @return int row count from query
 */

// initialize and assign aux arrays
$header = $rows = $r = [];

function xlxsReadFile(array $rows, Databases $db, $id)
{
// instance of XLXS File reader
    $xlsx = new SimpleXLSX($_FILES['excelUpload']['tmp_name']);

    foreach ($xlsx->rows() as $k => $r) {
        if ($k === 0) {
            $header_values = $r;
            continue;
        }
        $rows[] = array_combine($header_values, $r);
    }
    $result = $db->bulkUpload($id, $rows);
    return $result;
}

if(!empty($_SESSION["adminID"]) && isset($_FILES['excelUpload']))
{
    // instance of database
    $db = new Databases();

    // ref for admin
    $id = $_SESSION["adminID"];
    $result = xlxsReadFile($rows, $db, $id);

    echo json_encode(var_dump($result));
}
else {
    $sorry = "No information from the XLXS file.";
    echo json_encode($sorry);
}

<?php
//turn on error reporting
ini_set('display_errors', 1);

error_reporting(E_ALL);

$out = array();

$dir = "../../../assets/uploads/";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            array_push($out,$file);
        }
        closedir($dh);
    }
}
echo json_encode(var_dump($out));
echo json_encode($out); 

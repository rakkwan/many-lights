<?php


if ($_COOKIE) {
    echo "cookies set<br>";
    debug_to_console($_COOKIE['age']);
    echo json_decode($_COOKIE['age']);

}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
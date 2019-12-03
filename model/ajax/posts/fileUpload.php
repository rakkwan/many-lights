<?php
//turn on error reporting
ini_set('display_errors', 1);

error_reporting(E_ALL);

/* Getting file name */
$filename = $_FILES['file']['name'];

/* Location */
$location = "../../../assets/uploads/".$filename;
echo json_encode(var_dump($location));

$uploadOk = 1;

if($uploadOk == 0){
    echo 0;
    echo json_encode(var_dump($uploadOk));
}else{
    /* Upload file */
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        echo $location;
    }else{
        echo 0;
    }
}

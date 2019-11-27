<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 9:16 PM
 */

global $f3;
global $db;


//User Listings View
$f3->route('GET /resources', function ($f3) {

    global $db;
    $approved = 2;
    //Get Listings with Approved Status from resources in DB
    $data = $db->getViewListingInfo($approved);

    //Set the array to use in the table.
    $f3->set('res', $data);

    //check if the disclaimer approved beforecentralModalSuccess
    if ($_SESSION["approve"] == "yes" && !empty($_SESSION['approve'])) {
        $f3->set('approve', "yes");
    }

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/resources.html");
    echo $view->render('views/includes/footer.html');


});

//User Listings View
$f3->route('GET|POST /download', function ($f3) {

    if ($_COOKIE) {

//        echo print_r($_COOKIE);
//        echo print_r($_POST);
    } else {
        echo "submit wrong";
    }

    $view = new Template();


    echo $view->render("model/ajax/puts/downloadPdf.php");

//    echo "<script>location.reload(true)</script>";


});

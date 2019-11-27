<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 8:42 PM
 */


global $f3;
global $db;

// User personal contact info form route
$f3->route('GET|POST /recommended', function ($f3) {
    //If form has been submitted, validate

    if (!empty($_POST)) {
        // Get data from form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Add data to hive
        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('email', $email);
        $f3->set('phone', $phone);

        // save data in class session
        $_SESSION['RecommendedInfo'] = new RecommendedInfo($fname, $lname, $email, $phone);

        // if data is valid
        if (validForm()) {
            // Write data to session
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            // redirect to provider
            $f3->reroute('/resourceContact');
        }
    }

    if (!isset($_SESSION['RecommendedInfo'])) {
        $_SESSION['RecommendedInfo'] = new RecommendedInfo('', '', '', '');
    }


    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render('views/recommendedForm.html');
    echo $view->render('views/includes/footer.html');
});

<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 8:54 PM
 */


global $f3;
global $db;


// location form route
$f3->route('GET|POST /location', function ($f3) {
    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $website = $_POST['website'];

        $_SESSION['address'] = $address;
        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;
        $_SESSION['zip'] = $zip;
        $_SESSION['website'] = $website;

        // data to hive
        $f3->set('address', $address);
        $f3->set('city', $city);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('website', $website);

        // save data in class session
        $_SESSION['LocationForm'] = new LocationForm($address, $city, $state, $zip, $website);

        $f3->reroute('/optionalInfo');
    }

    if (!isset($_SESSION['LocationForm'])) {
        $_SESSION['LocationForm'] = new LocationForm('', '', '', '', '');
    }

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render('views/locationForm.html');
    echo $view->render('views/includes/footer.html');
});

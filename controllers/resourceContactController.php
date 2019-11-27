<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 8:50 PM
 */



global $f3;
global $db;

// office information form route
$f3->route('GET|POST /resourceContact', function ($f3) {

    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $service = $_POST['service'];
        $specialty = $_POST['specialty'];
        $office = $_POST['office'];
        $officePhone = $_POST['officePhone'];
        $officeEmail = $_POST['officeEmail'];
        $credential = $_POST['credential'];
        $theraFname = $_POST['theraFname'];
        $theraLname = $_POST['theraLname'];
        $theraGender = $_POST['theraGender'];

        // Add data to hive
        $f3->set('service', $service);
        $f3->set('specialty', $specialty);
        $f3->set('office', $office);
        $f3->set('officePhone', $officePhone);
        $f3->set('officeEmail', $officeEmail);
        $f3->set('credential', $credential);
        $f3->set('theraFname', $theraFname);
        $f3->set('theraLname', $theraLname);
        $f3->set('theraGender', $theraGender);

        // save data in class session
        $_SESSION['ResourceContact'] = new ResourceContact($service, $specialty, $office, $officePhone,
            $officeEmail, $theraFname, $theraLname, $theraGender);

        // if data is valid
        if (validOfficeForm()) {
            // Write data to session
            $_SESSION['service'] = $service;
            $_SESSION['specialty'] = $specialty;
            $_SESSION['office'] = $office;
            $_SESSION['officePhone'] = $officePhone;
            $_SESSION['officeEmail'] = $officeEmail;
            $_SESSION['credential'] = $credential;
            $_SESSION['theraFname'] = $theraFname;
            $_SESSION['theraLname'] = $theraLname;
            $_SESSION['theraGender'] = $theraGender;

            // reroute to location
            $f3->reroute('/location');
        }
    }

    if (!isset($_SESSION['ResourceContact'])) {
        $_SESSION['ResourceContact'] = new ResourceContact('', '', '', '',
            '', '', '', '');
    }

    //display the office form of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/resourceContactForm.html");
    echo $view->render('views/includes/footer.html');
});
<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 9:05 PM
 */

global $f3;
global $db;

// User Confirmation route
$f3->route('GET|POST /confirmation', function ($f3) {
    if (empty($_SESSION['days'])) {
        $_SESSION['date'] = 'No days selected';
    } else {
        if (isset($_SESSION['days'])) {
            $_SESSION['date'] = implode(', ', $_SESSION['days']);
        }
    }
    // Resource information check
    if (empty($_SESSION['specialty'])) {
        $_SESSION['confirmSpecialty'] = "No entry";
    } else {
        $_SESSION['confirmSpecialty'] = $_SESSION['specialty'];
    }
    if (empty($_SESSION['credential'])) {
        $_SESSION['confirmCredential'] = "No entry";
    } else {
        $_SESSION['confirmCredential'] = $_SESSION['credential'];
    }
    if (empty($_SESSION['theraFname'])) {
        $_SESSION['confirmTheraFname'] = "No entry";
    } else {
        $_SESSION['confirmTheraFname'] = $_SESSION['theraFname'];
    }
    if (empty($_SESSION['theraLname'])) {
        $_SESSION['confirmTheraLname'] = "No entry";
    } else {
        $_SESSION['confirmTheraLname'] = $_SESSION['theraLname'];
    }
    if (empty($_SESSION['theraGender'])) {
        $_SESSION['confirmTheraGender'] = "Not selected";
    } else {
        $_SESSION['confirmTheraGender'] = $_SESSION['theraGender'];
    }

    // Location information check
    if (empty($_SESSION['address'])) {
        $_SESSION['confirmAddress'] = "No entry";
    } else {
        $_SESSION['confirmAddress'] = $_SESSION['address'];
    }
    if (empty($_SESSION['city'])) {
        $_SESSION['confirmCity'] = "No entry";
    } else {
        $_SESSION['confirmCity'] = $_SESSION['city'];
    }
    if (empty($_SESSION['zip'])) {
        $_SESSION['confirmZip'] = "No entry";
    } else {
        $_SESSION['confirmZip'] = $_SESSION['zip'];
    }
    if (empty($_SESSION['website'])) {
        $_SESSION['confirmWebsite'] = "No entry";
    } else {
        $_SESSION['confirmWebsite'] = $_SESSION['website'];
    }

    // Optional information check
    if (empty($_SESSION['interpreter'])) {
        $_SESSION['interpreter'] = "No entry";
    }
    if (empty($_SESSION['insurance'])) {
        $_SESSION['insurance'] = "No entry";
    }
    if (empty($_SESSION['fee'])) {
        $_SESSION['fee'] = "No entry";
    }

    global $db;

    $db->getServiceID($_SESSION['service']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f3->reroute('/submitted');
    }


    //display the confirmation of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/confirmation.html");
    echo $view->render('views/includes/footer.html');
});


$f3->route('GET /submitted', function ($f3) {
    global $db;

    // Insert  recommendedInfo into the database
    $recommendedInfo = new RecommendedInfo(
        $_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['phone']);
    $db->recommendedInfo($recommendedInfo);
    $f3->set('recommendedInfoID', $f3->get('recommendedInfoID'));


    // Insert resourceContact into the database
    $resourceInfo = new ResourceContact(
        $_SESSION['service'], $_SESSION['specialty'], $_SESSION['office'], $_SESSION['officePhone'],
        $_SESSION['officeEmail'], $_SESSION['theraFname'], $_SESSION['theraLname'], $_SESSION['theraGender']);

    // Get service ID
    $db->getServiceID($_SESSION['service']);
    $f3->set('serviceID', implode($f3->get('serviceID')));

    $db->resourceInfo($resourceInfo);
    $_SESSION['resourceID'] = $f3->get('resourceID');


    // Update location information into the database
    $locationInfo = new LocationForm(
        $_SESSION['address'], $_SESSION['city'], $_SESSION['state'],
        $_SESSION['zip'], $_SESSION['website']);

    $db->updateLocation($locationInfo, $_SESSION['resourceID']);


    // Update optionalInfo into the database
    $optionalInfo = new OptionalInfo(
        $_SESSION['ageSeen'], $_SESSION['interpreter'], $_SESSION['insurance'], $_SESSION['fee']);

    $db->updateOptionalInfo($optionalInfo, $_SESSION['resourceID']);


    // Insert dayHour into the database
    if (!empty($_SESSION['days'])) {
        foreach ($_SESSION['days'] as $day) {
            $db->dayHours($day, $_SESSION[$day . 'FromTime'], $_SESSION[$day . 'ToTime'], $_SESSION['resourceID']);
        }
    }

    // Insert county into the database
    $db->updateCounties($_SESSION['countyOne'], $_SESSION['countyTwo'], $_SESSION['countyThree'], $_SESSION['resourceID']);

    // Mail to admin someone sent recommendation
    $to = "sle11@mail.greenriver.edu, jgoodrich4@mail.greenriver.edu";
    $subject = "Recommendation was submitted";
    $name = $_SESSION['fname'] . " " . $_SESSION['lname'];
    $link = '<a href="https://coderlite.greenriverdev.com/IT355/oneStopWa/adminLogin">Click here</a>';
    $message = $name . " have sent an recommendation please check One Stop WA admin page with the link below \n" . $link;
    $headers =
        'From: onestopwa@noreply.com' . "\r\n" .
        'Reply-To: onestopwa@noreply.com' . "\r\n" .
        'Return-Path: onestopwa@noreply.com' . "\r\n" .
        'Organization: One Stop WA' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'X-Priority: 3' . "\r\n" .
        'X-Mailer: PHP". phpversion()' . "\r\n" .
        'Content-type: text/html; charset=iso-8859-1';

    mail($to, $subject, $message, $headers);

    //display the submitted form of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/submittedForm.html");
    echo $view->render('views/includes/footer.html');
    session_destroy();
});

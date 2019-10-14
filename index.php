<?php
/**
 * Created by PhpStorm.
 * User: samantha
 * Date: 2019-10-04
 * Time: 15:09
 */

// Start session!
session_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');
require_once('model/validation.php');
require_once('model/officeValidation.php');

//create an instance of the Base class/ fat free object
$f3 = Base::instance();

//Define a default root, there can be multiple routes

//homepage
$f3->route('GET /', function () {
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET /home', function () {
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET /resources', function ($f3) {

    //display the contents of the page
    $view = new Template();
    $f3->set('title', "Resources");

//    echo $view->render('views/includes/header.html');
    echo $view->render("views/resources.html");
//    echo $view->render('views/includes/footer.html');
});

// recommended form
$f3->route('GET|POST /recommended', function ($f3)
{
    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        //$address = $_POST['address'];
        $email = $_POST['email'];
        $phone =$_POST['phone'];
        //$message = $_POST['message'];

        // Add data to hive
        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        //$f3->set('address', $address);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        //$f3->set('message', $message);

        // if data is valid
        if (validForm())
        {
            // Write data to session
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            //$_SESSION['address'] = $address;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            //$_SESSION['message'] = $message;

            // redirect to confirmation
            $f3->reroute('/provider');
        }
    }

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render('views/recommendedForm.html');
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET|POST /provider', function ($f3)
{
    //If form has been submitted, validate
    if (!empty($_POST)) {

        // Get data from form
        $office = $_POST['office'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip =$_POST['zip'];
        $office_phone = $_POST['office_phone'];
        $office_email = $_POST['office_email'];
        $website = $_POST['website'];
        $comments = $_POST['comments'];

        // Add data to hive
        $f3->set('office', $office);
        $f3->set('address', $address);
        $f3->set('city', $city);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('office_phone', $office_phone);
        $f3->set('office_email', $office_email);
        $f3->set('website', $website);
        $f3->set('comments', $comments);

        // if data is valid
        if (validOfficeForm())
        {
            // Write data to session
            $_SESSION['office'] = $office;
            $_SESSION['office_email'] = $office_email;
            $_SESSION['office_phone'] = $office_phone;

            // redirect to confirmation
            $f3->reroute('/confirmation');
        }
    }

    //display the office form of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/officeForm.html");
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET|POST /confirmation', function ($f3) {
    //display the confirmation of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/confirmation.html");
    echo $view->render('views/includes/footer.html');
});


//run Fat-free
$f3->run();
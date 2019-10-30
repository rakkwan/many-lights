<?php


require_once('vendor/autoload.php');

/**
 * Created by PhpStorm.
 * User: samantha, Jittima, Robert, Sang
 * Date: 2019-10-04
 * Time: 15:09
 */

// Start session!
session_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
//require_once ('vendor/autoload.php');
require_once('model/validation.php');
require_once('model/officeValidation.php');
require_once('model/thereapistValidation.php');
require_once('model/database.php');

//create an instance of the Base class/ fat free object
$f3 = Base::instance();

//create instance of Database
$db = new Databases();

// Set days array
$f3->set('day', array('Sunday', 'Monday', 'Tuesday', 'Wednesday',
    'Thursday', 'Friday', 'Saturday'));

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// arrays of age
$f3->set('age', array('0-4', '5-9', '10-12', '13-17', '18+'));

//Define a default root, there can be multiple routes

//homepage
$f3->route('GET /', function () {
    //display the contents of the page
    session_destroy();
    session_start();

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET /home', function () {
    session_destroy();
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/includes/footer.html');
});

$f3->route('GET /resources', function ($f3) {

    //load with DB values with array
    global $db;
    //Proof the db is connected

    $resources_data = $db->getResourcesMain();

    echo "<pre>" . $resources_data . "</pre>";
    var_dump($resources_data);


    //display the contents of the page
    $view = new Template();
    $f3->set('title', "Resources");

    echo $view->render('views/includes/header.html');
    echo $view->render("views/resources.html");
    echo $view->render('views/includes/footer.html');
});

/*
 * Clickable row route
 */
$f3->route('GET /resources/service/@type', function ($f3) {
    //display the contents of the page
    $view = new Template();
    $f3->set('title', 'Service');
    $f3->set('resource', $f3->get('PARAMS.type'));
    echo $view->render('views/includes/header.html');
    echo $view->render("views/serviceResource.html");
    echo $view->render('views/includes/footer.html');
});

// personal contact info form route
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

            //insert the recommendedInfo into the database
            $recommendedInfo = new RecommendedInfo($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone']);


            global $db;
            $db->recommendedInfo($recommendedInfo);
            $_SESSION['recommendedInfoID'] = $f3->get('recommendedInfoID');

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
        $theraFname = $_POST['theraFname'];
        $theraLname = $_POST['theraLname'];
        $theraGender = $_POST['theraGender'];

        // Add data to hive
        $f3->set('service', $service);
        $f3->set('specialty', $specialty);
        $f3->set('office', $office);
        $f3->set('officePhone', $officePhone);
        $f3->set('officeEmail', $officeEmail);
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
            $_SESSION['theraFname'] = $theraFname;
            $_SESSION['theraLname'] = $theraLname;
            $_SESSION['theraGender'] = $theraGender;


            //insert the recommendedInfo into the database
            $service = new ResourceContact($_POST['service'],
                $_POST['specialty'], $_POST['office'], $_POST['officePhone'], $_POST['officeEmail'],
                $_POST['theraFname'], $_POST['theraLname'], $_POST['theraGender']);

            global $db;
//            $db->serviceInfo($service);
//            $_SESSION['serviceID'] = $f3->get('serviceID');

//            $serviceID = $db->getServiceID($_SESSION['service']);
//            $f3->set('serviceID', $serviceID);

            $db->resourceInfo($service);
            $_SESSION['resourceID'] = $f3->get('resourceID');

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

// therapist form route
$f3->route('GET|POST /location', function ($f3) {
    //If form has been submitted, validate
    if (!empty($_POST)) {

        // Get data from form
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $website = $_POST['website'];


        // do data to hive
        $f3->set('address', $address);
        $f3->set('city', $city);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('website', $website);

        // save data in class session
        $_SESSION['LocationForm'] = new LocationForm($address, $city, $state, $zip, $website);

        $locationInfo = new LocationForm($_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['website']);
        global $db;
        $_SESSION['resourceID'] = $f3->get('resourceID');
        $db->updateLocation($locationInfo, $_SESSION['resourceID']);


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

// optional information route
$f3->route('GET|POST /optionalInfo', function ($f3) {

    //session_destroy();
    //session_start();
    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $age = $_POST['age'];
        $interpreter = $_POST['interpreter'];
        $insurance = $_POST['insurance'];
        $fee = $_POST['fee'];

        if (sizeof($age) == 0) {
            $age = array('1', '2');
        }

        // Add data to hive
        $f3->set('age', $age);
        $f3->set('interpreter', $interpreter);
        $f3->set('insurance', $insurance);
        $f3->set('fee', $fee);

        $_SESSION['OptionalInfo'] = new OptionalInfo($age, $interpreter, $insurance, $fee);
        // if data is valid
        if (!empty($_POST)) {
            // Write data to session
            $_SESSION['age'] = $age;
            $_SESSION['interpreter'] = $interpreter;
            $_SESSION['insurance'] = $insurance;
            $_SESSION['fee'] = $fee;

            if (empty($age)) {
                $_SESSION['age'] = "No age selected";
            } else {
                $_SESSION['age'] = implode(', ', $age);
            }

            // redirect to datHour page
            $f3->reroute('/dayHour');
        }
    }


    if (!isset($_SESSION['OptionalInfo'])) {
        $dummy = array('1', '2');
        $_SESSION['OptionalInfo'] = new OptionalInfo($dummy, '', '', '');
    }

    //display the confirmation of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/optionalForm.html");
    echo $view->render('views/includes/footer.html');
});


// day and hour information route
$f3->route('GET|POST /dayHour', function ($f3) {

    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $days = $_POST['days'];
        $countyOne = $_POST['countyOne'];
        $countyTwo = $_POST['countyTwo'];
        $countyThree = $_POST['countyThree'];

        $_SESSION['days'] = $days;
        $_SESSION['countyOne'] = $countyOne;
        $_SESSION['countyTwo'] = $countyTwo;
        $_SESSION['countyThree'] = $countyThree;



        if (!empty($days)) {
            // loop through and check which days are checked
            foreach ($_POST['days'] as $day) {
                if (isset($day)) {
                    // Add data to hive and set session for time
                    $_SESSION[$day . 'FromTime'] = date('h:i A', strtotime($_POST[$day . 'FromTime']));
                    $f3->set($day . 'FromTime', $_POST[$day . 'FromTime']);

                    $_SESSION[$day . 'ToTime'] = date('h:i A', strtotime($_POST[$day . 'ToTime']));
                    $f3->set($day . 'ToTime', $_POST[$day . 'ToTime']);
                }
            }
        }

        if(sizeof($days) == 0) {
            $days = array('No days selected');
        }


        // Add data to hive
        $f3->set('days', $days);
        $f3->set('countyOne', $countyOne);
        $f3->set('countyTwo', $countyTwo);
        $f3->set('countyThree', $countyThree);

        $_SESSION['DayHourInfo'] = new DayHourInfo($days, $countyOne, $countyTwo, $countyThree);


        // redirect to confirmation
        $f3->reroute('/confirmation');
    }

    if(!isset($_SESSION['DayHourInfo'])) {
        $noInput = array('1', '2');
        $_SESSION['DayHourInfo'] = new DayHourInfo($noInput, '', '', '');
    }

    //display the day and hour of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/dayHourForm.html");
    echo $view->render('views/includes/footer.html');
});


// Confirmation route
$f3->route('GET|POST /confirmation', function ($f3) {
    if (empty($_SESSION['days'])) {
        foreach ($f3->get('day') as $day) {
            $_SESSION[$day . 'NoTime'] = 'No time selected';
        }
        $_SESSION['days'] = 'No days selected';
    } else {
        foreach ($f3->get('day') as $date) {
            if (!in_array($date, $_SESSION['days'])) {
                $_SESSION[$date . 'NoTime'] = 'No time selected';
            }
        }
        $_SESSION['days'] = implode(', ', $_SESSION['days']);
    }

    global $db;

    //retrieve the recomendedInfo
    $recommendedInfo = $db->getRecommendedInfo($_SESSION['recommendedInfoID']);
    $f3->set('recommendedInfo', $recommendedInfo);
    $service = $db->getServiceInfo($_SESSION['service']);
    $f3->set('service', $service);
    $resourceInfo = $db->getResourceInfo($_SESSION['resourceID']);
    $f3->set('resourceInfo', $resourceInfo);
    //$updateLocationInfo = $db->updateLocation(['resourceID']);
    //$f3->set('resourceID', $updateLocationInfo);


    //display the confirmation of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/confirmation.html");
    echo $view->render('views/includes/footer.html');
    session_destroy();
});

//Admin to be able to view recommended resource listings to update listings Status
$f3->route('GET|POST /admin', function ($f3) {
    //display the admin page

    //Get the DB instance
    global $db;
    //Proof the db is connected

    $fields = $db->getResource();

    //var dumps the resources. DUMMY Test data alot!!!
    foreach ($fields as $outer_key => $array) {
        foreach ($array as $inner_key => $value) {

            if ($inner_key === 'Field') {
                if (!(int)$inner_key) {
                    $this->column_names[] = $value;
                }
            }
        }
    }

    var_dump($fields);

//    $view = new Template();
//    echo $view->render('views/includes/header.html');
//    echo $view->render('views/adminView.html');
//    echo $view->render('views/includes/footer.html');
});

//run Fat-free
$f3->run();
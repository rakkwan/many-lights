<?php

//Require autoload file
require_once __DIR__ . '/vendor/autoload.php';


/**
 * Created by PhpStorm.
 * User: samantha, Jittima, Robert, Sang
 * Date: 2019-10-04
 * updated 11/1/2019 - reordered the routes by workflow
 * Time: 15:09
 */

// Start session!
session_start();


//turn on error reporting
ini_set('display_errors', 1);

error_reporting(E_ALL);

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
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/includes/footer.html');
});

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
        $credentail = $_POST['credential'];
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
            $_SESSION['credential'] = $credentail;
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

        $_SESSION['address'] = $address;
        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;
        $_SESSION['zip'] = $zip;
        $_SESSION['website'] = $website;


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

// User optional information route
$f3->route('GET|POST /optionalInfo', function ($f3) {

    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $age = $_POST['age'];
        $interpreter = $_POST['interpreter'];
        $insurance = $_POST['insurance'];
        $fee = $_POST['fee'];

        // Add data to hive
        $f3->set('interpreter', $interpreter);
        $f3->set('insurance', $insurance);
        $f3->set('fee', $fee);

        $_SESSION['OptionalInfo'] = new OptionalInfo($age, $interpreter, $insurance, $fee);
        // if data is valid
        if (!empty($_POST)) {
            // Write data to session
            $_SESSION['ages'] = $age;
            $_SESSION['interpreter'] = $interpreter;
            $_SESSION['insurance'] = $insurance;
            $_SESSION['fee'] = $fee;

            if (empty($age)) {
                $_SESSION['ageSeen'] = "No age selected";
            } else {
                $_SESSION['ageSeen'] = implode(', ', $age);
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


//User day and hour information route
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

        if (sizeof($days) == 0) {
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

    if (!isset($_SESSION['DayHourInfo'])) {
        $noInput = array('1', '2');
        $_SESSION['DayHourInfo'] = new DayHourInfo($noInput, '', '', '');
    }

    //display the day and hour of the page
    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/dayHourForm.html");
    echo $view->render('views/includes/footer.html');
});

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


//User Listings View
$f3->route('GET /resources', function ($f3) {

    global $db;
    $approved = 2;
    //Get Listings with Approved Status from resources in DB
    $data = $db->getViewListingInfo($approved);

    //Set the array to use in the table.
    $f3->set('res', $data);

    //check if the disclaimer approved before
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
        echo $_COOKIE['refresh'];
    } else {
        echo "submit wrong";
    }

    $view = new Template();


    echo $view->render("model/ajax/puts/downloadPdf.php");

});


/***********************************************************************************
 * ---------------------------------------------------------------------------------
 *                                  Admin Routes
 * ---------------------------------------------------------------------------------
 ***********************************************************************************/
//Admin Login
$f3->route('GET|POST /adminLogin', function ($f3) {

    // if admin already logged in then take admin to the admin page
    if (!empty($_SESSION['adminID']) && $_SESSION['masterAdmin']) {
        $f3->reroute('/admin');
    }
    if (!empty($_POST)) {

        global $db;
        // try to login - checks if adminEmail and password are in the database
        $admin = $db->adminLogin($_POST['adminEmail'], $_POST['adminPassword']);

        // if a result is retrieved from the database
        if (!empty($admin['adminID']) && ($admin['masterAdmin']) == 1) {
            // add the adminID to session and then go to admin page
            $_SESSION['adminID'] = $f3->get('adminID');
            $_SESSION['masterAdmin'] = $f3->get('masterAdmin');
            $f3->reroute('/adminDashboard');
        } elseif (!empty($admin['adminID']) && ($admin['masterAdmin']) == 0) {
            $_SESSION['adminID'] = $f3->get('adminID');
            $_SESSION['masterAdmin'] = $f3->get('masterAdmin');
            $f3->reroute('/admin');
        }
        $f3->set('errors', 'Admin email and password do not match');
    }

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/adminLogin.html");
    echo $view->render('views/includes/footer.html');
});


//Admin Dashboard
$f3->route('GET|POST /adminDashboard', function ($f3) {

    global $db;

    // retrieve the new admin's info
    $admin = $db->getAllAdmin();
    $f3->set('admin', $admin);

    // get all resources
    $resources = $db->getResourceInfo();

    $countMaster = 0;
    $countStandard = 0;
    $countPending = 0;

    // count the type of admin
    foreach($admin as $row) {
        if($row['masterAdmin'] == 1) {
            $countMaster++;
        }
        else {
            $countStandard++;
        }
    }

    // count the pending resources
    foreach($resources as $row) {
        if($row['statusID'] == 1) {
            $countPending++;
        }
    }

    // add counter to hive
    $f3->set('countMaster', $countMaster);
    $f3->set('countStandard', $countStandard);
    $f3->set('countPending', $countPending);


    $view = new Template();
    echo $view->render('views/adminDashboard/includes/header.html');
    echo $view->render('views/adminDashboard/adminDashboard.html');
    echo $view->render('views/adminDashboard/includes/footer.html');
});

//Add a new Admin
$f3->route('GET|POST /addAdmin', function ($f3) {
    global $db;

    if (!empty($_POST))
    {
        // get data from the form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $adminEmail = $_POST['adminEmail'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $adminType = $_POST['adminType'];

        // add data to hive
        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('adminEmail', $adminEmail);
        $f3->set('password', $password);
        $f3->set('repeatPassword', $repeatPassword);
        $f3->set('adminType', $adminType);


        if(validCreateAdmin())
        {
            if ($adminType == '0')
            {
                $adminType = false;
            }
            else {
                $adminType = true;
            }
            // create a new admin and add them into the database
            $admin = new AddAdmin($_POST['adminEmail'], $_POST['password'], $adminType, $_POST['fname'], $_POST['lname']);

            $db->createAdmin($admin);
            $_SESSION['adminID'] = $f3->get('adminID');
            $f3->reroute('/adminDashboard');
        }

    }
    $view = new Template();
    echo $view->render('views/adminDashboard/includes/header.html');
    echo $view->render('views/createAdmin.html');
    echo $view->render('views/adminDashboard/includes/footer.html');
});


// Admin resetPassword
$f3->route('GET|POST /resetPassword', function ($f3) {

    global $db;

    // if the admin is trying to change the password
    if (!empty($_POST)) {
        // if a result is retrieved from the database
        if (!empty($_POST['adminEmail1'])) {
            //check admin email address
            $admin = $db->getAdmin($_POST['adminEmail1']);
            if (empty($admin)) {
                $f3->set('errors[adminEmail1]', 'Invalid admin email address');
            } else {
                $_SESSION['email'] = implode($admin);
            }

            // change the admin password
            if (isset($_POST['newPassword1'], $_POST['newPassword'])) {
                $f3->set('newPassword', $_POST['newPassword']);
                $f3->set('newPassword1', $_POST['newPassword1']);
                if (validNewPassword()) {
                    $db->changePassword($_SESSION['email'], $f3->get('newPassword1'));
                    $f3->reroute('/succeedResetPassword');
                }
            } else {
                $f3->set("errors['newPassword']", "Please enter your new password");
            }
        } else {
            $f3->set('errors[adminEmail1]', 'Please enter an admin email address');
        }
    }

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/resetPassword.html");
    echo $view->render('views/includes/footer.html');

});

// Admin Logout
$f3->route('GET|POST /adminLogout', function ($f3) {

    // if the admin is not logged in, then go to login page
    if (empty($_SESSION['adminID'])) {
        $f3->reroute('/adminLogin');
    }

    // clear the variable
    $_SESSION = [];
    // destroy the session itself
    session_destroy();

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/adminLogout.html");
    echo $view->render('views/includes/footer.html');

});


// Admin succeed reset password
$f3->route('GET|POST /succeedResetPassword', function ($f3) {
    print $f3->get('adminType');

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/succeedResetPassword.html");
    echo $view->render('views/includes/footer.html');


});

//Admin Listing View
$f3->route('GET|POST /admin', function ($f3) {

    global $db;

    //Get the info from DB for admin Data Table Listings
    $data = $db->getAdminListingInfo();

    $f3->set('res', $data);
    $f3->set('comma', ",");

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("views/admin.html");
    echo $view->render('views/includes/footer.html');
});

/**
 *
 *
 * !!!!!!!!!!!!!!!!!!!! DEVELOPER ONLY Routes!!!!!!!!!!!!!!!!!!!!
 *
 *
 */
//Test route
$f3->route('GET|POST /dev', function ($f3) {

    $view = new Template();
    echo $view->render('views/includes/header.html');
    echo $view->render("Test HTML");
    echo $view->render('views/includes/footer.html');
    session_destroy();

});

$f3->set('DEBUG', 0);
//run Fat-free
$f3->run();
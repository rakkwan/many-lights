<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 9:13 PM
 */

global $f3;
global $db;


////Admin Login
//$f3->route('GET|POST /adminLogin', function ($f3) {
//
//    // if admin already logged in then take admin to the admin page
//    if (!empty($_SESSION['adminID']) && $_SESSION['masterAdmin']) {
//        $f3->reroute('/admin');
//    }
//    if (!empty($_POST)) {
//        global $db;
//
//        // try to login - checks if adminEmail and password are in the database
//        $admin = $db->adminLogin($_POST['adminEmail'], $_POST['adminPassword']);
//
//        $f3->set('adminName', $f3->get('adminName'));
//
////        if (password_verify($_POST['adminPassword'], $admin['password']))
////        {
////            echo $_POST['adminPassword'];
////            echo $admin['password'];
////
////        }
//
//        // if a result is retrieved from the database
//        if (!empty($admin['adminID']) && ($admin['masterAdmin']) == 1) {
//            // add the adminID to session and then go to admin page
//            $_SESSION['adminID'] = $f3->get('adminID');
//            $_SESSION['masterAdmin'] = $f3->get('masterAdmin');
//            $_SESSION['admin'] = true;
//            $f3->reroute('/adminDashboard');
//        } elseif (!empty($admin['adminID']) && ($admin['masterAdmin']) == 0) {
//            $_SESSION['adminID'] = $f3->get('adminID');
//            $_SESSION['masterAdmin'] = $f3->get('masterAdmin');
//            $_SESSION['admin'] = true;
//            $f3->reroute('/admin');
//        }
//        $f3->set('errors', 'Admin email and password do not match');
//    }
//    $view = new Template();
//    echo $view->render('views/includes/header.html');
//    echo $view->render("views/adminLogin.html");
//    echo $view->render('views/includes/footer.html');
//});

//Admin Login
$f3->route('GET|POST /adminLogin', function ($f3) {

    // if admin already logged in then take admin to the admin page
    if (!empty($_SESSION['adminID']) && ($_SESSION['masterAdmin']) == 1) {
        $f3->reroute('/adminDashboard');
    }

    if (!empty($_SESSION['adminID']) && ($_SESSION['masterAdmin']) == 0) {
        $f3->reroute('/admin');
    }

    if (!empty($_POST)) {

        global $db;
        // try to login - checks if adminEmail and password are in the database
        $adminPassword = $_POST['adminPassword'];
        $adminEmail = $_POST['adminEmail'];

        // check the email
        $adminLogin = $db->checkEmail($adminEmail);
        $_SESSION['adminName'] = $adminLogin['fname'];

        // verify password
        if ($adminPassword == $adminLogin['password'] || password_verify($adminPassword, $adminLogin['password']))
        {
            // if a result is retrieved from the database
            if (!empty($adminLogin['adminID']) && ($adminLogin['masterAdmin']) == 1) {
                // add the adminID to session and then go to admin page
                $_SESSION['adminID'] = $adminLogin['adminID'];
                $_SESSION['masterAdmin'] = $adminLogin['masterAdmin'];
                $_SESSION['admin'] = true;
                $f3->reroute('/adminDashboard');
            } elseif (!empty($admin['adminID']) && ($admin['masterAdmin']) == 0) {
                $_SESSION['adminID'] = $adminLogin['adminID'];
                $_SESSION['masterAdmin'] = $adminLogin['masterAdmin'];
                $_SESSION['admin'] = true;
                $f3->reroute('/admin');
            }
            $f3->set('errors', 'Admin email and password do not match');
        }
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
    $countApproved = 0;
    $countDeclined = 0;
    $countResources = 0;

    // count the type of admin
    foreach ($admin as $row) {
        if ($row['masterAdmin'] == 1) {
            $countMaster++;
        } else {
            $countStandard++;
        }
    }


    foreach ($resources as $row) {
        // count the pending resources
        if ($row['statusID'] == 1) {
            $countPending++;
        } // count the declined resources
        elseif ($row['statusID'] == 3) {
            $countDeclined++;
        } else {
            // count the Approved resources
            $countApproved++;
        }
    }

    // count total resources
    $countResources = $countDeclined + $countApproved + $countPending;

    // add counter to hive
    $f3->set('countMaster', $countMaster);
    $f3->set('countStandard', $countStandard);
    $f3->set('countPending', $countPending);
    $f3->set('countApproved', $countApproved);
    $f3->set('countDeclined', $countDeclined);
    $f3->set('countResources', $countResources);


    $adminID = $_POST['removeID'];


    if (isset($adminID)) {
        header('Location: '.$_SERVER['REQUEST_URI']);
        $db->deleteAdmin($adminID);
    }

    /**
     * admin Page Appended
     */

    //Get the info from DB for admin Data Table Listings
    $data = $db->getAdminListingInfo();

    $f3->set('res', $data);
    $f3->set('comma', ",");

    $view = new Template();

    // if admin is logged in load the page else reroute to admin login
    if($_SESSION['admin'] == true) {
        echo $view->render('views/adminDashboard/includes/header.html');
        echo $view->render('views/adminDashboard/adminDashboard.html');
        echo $view->render('views/adminDashboard/includes/footer.html');
    }
    else {
        $f3->reroute('/adminLogin');
    }
});

//Add a new Admin
$f3->route('GET|POST /addAdmin', function ($f3) {
    global $db;

    if (!empty($_POST)) {
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


        if (validCreateAdmin()) {
            if ($adminType == '0') {
                $adminType = false;
            } else {
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
    // if admin is logged in load the page else reroute to admin login
    if($_SESSION['admin'] == true) {
        echo $view->render('views/adminDashboard/includes/header.html');
        echo $view->render('views/createAdmin.html');
        echo $view->render('views/adminDashboard/includes/footer.html');
    }
    else {
        $f3->reroute('/adminLogin');
    }

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

    // if admin is logged in, load page else reroute to admin login
    if($_SESSION['admin'] == true) {
        echo $view->render('views/includes/header.html');
        echo $view->render("views/admin.html");
        echo $view->render('views/includes/footer.html');
    }
    else {
        $f3->reroute('/adminLogin');
    }
});

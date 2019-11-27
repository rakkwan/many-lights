<?php

//Require autoload file
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/model/database.php';

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



/***********************************************************************************
 * ---------------------------------------------------------------------------------
 *                                  Admin Routes
 * ---------------------------------------------------------------------------------
 ***********************************************************************************/

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

// controllers
require_once 'controllers/homeController.php';
require_once 'controllers/recommendedFormController.php';
require_once 'controllers/resourceContactController.php';
require_once 'controllers/locationFormController.php';
require_once 'controllers/optionalInfoController.php';
require_once 'controllers/dayHourFormController.php';
require_once 'controllers/confirmationController.php';
require_once 'controllers/adminController.php';
require_once 'controllers/resourcesController.php';



$f3->set('DEBUG', 0);
//run Fat-free
$f3->run();
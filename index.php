<?php
/**
 * Created by PhpStorm.
 * User: samantha
 * Date: 2019-10-04
 * Time: 15:09
 */


//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class/ fat free object
$f3 = Base::instance();

//Define a default root, there can be multiple routes

//homepage
$f3->route('GET /', function () {
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/footer.html');
});

$f3->route('GET /home', function () {
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/header.html');
    echo $view->render("views/homePage.html");
    echo $view->render('views/footer.html');
});

$f3->route('GET /resources', function () {
      //Test
//    echo "<h1>This is TEST resources Page</h1>";
//        print_r($_POST);
    //display the contents of the page
    $view = new Template();
    echo $view->render('views/header.html');
    echo $view->render("views/resources.html");
    echo $view->render('views/footer.html');
});


//run Fat-free
$f3->run();
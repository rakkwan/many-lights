<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 9:03 PM
 */

global $f3;
global $db;

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

        // Check if days is checked
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

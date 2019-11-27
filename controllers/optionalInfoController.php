<?php
/**
 * Created by PhpStorm.
 * Author: Jittima Goodrich, Sang Le, Robert Hill, Samantha DeSmul
 * Copyright: 11/26/2019
 * Time: 9:01 PM
 */

global $f3;
global $db;


// User optional information route
$f3->route('GET|POST /optionalInfo', function ($f3) {
    //If form has been submitted, validate
    if (!empty($_POST)) {
        // Get data from form
        $ages = $_POST['ages'];
        $interpreter = $_POST['interpreter'];
        $insurance = $_POST['insurance'];
        $fee = $_POST['fee'];

        // Write data to session
        $_SESSION['ages'] = $ages;
        $_SESSION['interpreter'] = $interpreter;
        $_SESSION['insurance'] = $insurance;
        $_SESSION['fee'] = $fee;

        // Add data to hive
        $f3->set('interpreter', $interpreter);
        $f3->set('insurance', $insurance);
        $f3->set('fee', $fee);

        if (empty($ages)) {
            $_SESSION['ageSeen'] = "No age selected";
        } else {
            $_SESSION['ageSeen'] = implode(', ', $ages);
        }

        if(sizeof($ages) == 0) {
            $ages = array('No ages selected');
        }

        $_SESSION['OptionalInfo'] = new OptionalInfo($ages, $interpreter, $insurance, $fee);

        // redirect to datHour page
        $f3->reroute('/dayHour');
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

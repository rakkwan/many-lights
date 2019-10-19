<?php
/**
 * Validation file for the form
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/6/2019
 * Time: 7:36 PM
 * @copyright 2019
 */


/**
 * used to validate the recommended form
 * @return bool if everything was valid or not
 */
function validTherapist()
{
    global $f3;
    $isValid = true;
    if (!validTherapistName($f3->get('theraFname')))
    {
        $isValid = false;
        $f3->set("errors['theraFname']", "Please enter a valid first name");
    }
    if (!validTherapistName($f3->get('theraLname')))
    {
        $isValid = false;
        $f3->set("errors['theraLname']", "Please enter a valid last name");
    }
    if (!validTherapistEmail($f3->get('theraEmail')))
    {
        $isValid = false;
        $f3->set("errors['theraEmail']", "Please enter a valid email address");
    }
    if (!validTherapistPhone($f3->get('theraPhone')))
    {
        $isValid = false;
        $f3->set("errors['theraPhone']", "Please enter a phone number, must be 10 digits");
    }
    if (!validGender($f3->get('theraGender')))
    {
        $isValid = false;
        $f3->set("errors['theraGender']", "Please select a gender");
    }

    return $isValid;
}

/**
 * Checks if the name given was valid
 * @param String $name the name given
 * @return bool if the name was valid
 */
function validTherapistName($name)
{
    return !empty($name) && ctype_alpha($name);
}

/**
 * Checks if the email is valid
 * @param String $email the email given
 * @return bool if the email was valid ot not
 */

function validTherapistEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * check to see that the phone number is valid
 * @param $phone
 * @return bool
 */
function validTherapistPhone($phone)
{
    //eliminate every char except 0-9
    $justNums = preg_replace("/[^0-9]/", '', $phone);

    //if we have 10 digits left, it's probably valid.
    return strlen($justNums) == 10;
}

function validGender($gender) {
    return isset($gender);
}


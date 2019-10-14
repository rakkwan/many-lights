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
function validForm()
{
    global $f3;
    $isValid = true;
    if (!validName($f3->get('fname')))
    {
        $isValid = false;
        $f3->set("errors['fname']", "Please enter a valid first name");
    }
    if (!validName($f3->get('lname')))
    {
        $isValid = false;
        $f3->set("errors['lname']", "Please enter a valid last name");
    }
    if (!validEmail($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email address");
    }
    if (!validPhone($f3->get('phone')))
    {
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a phone number, must be 10 digits");
    }
    return $isValid;
}

/**
 * Checks if the name given was valid
 * @param String $name the name given
 * @return bool if the name was valid
 */
function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}

/**
 * Checks if the address is empty
 * @param String $address the address given
 * @return bool if the address was valid
 */
function validAddress($address)
{
    return !empty($address);
}

/**
 * Checks if the email is valid
 * @param String $email the email given
 * @return bool if the email was valid ot not
 */

function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * check to see that the phone number is valid
 * @param $phone
 * @return bool
 */
function validPhone($phone)
{
    return !empty($phone) && ctype_digit($phone) && strlen($phone) == 10;
}

/**
 * checks if the message is valid, can't be empty
 * @param $message String $message the message given
 * @return bool if the message was valid or not
 */
function validMessage($message)
{
    return !empty($message);
}

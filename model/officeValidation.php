<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/13/2019
 * Time: 5:36 PM
 */

/**
 * used to validate the office form
 * @return bool if everything was valid or not
 */

function validOfficeForm()
{
    global $f3;
    $isValid = true;
    if (!validOffice($f3->get('office')))
    {
        $isValid = false;
        $f3->set("errors['office']", "Please enter a valid office's name");
    }

    if (!validOfficeEmail($f3->get('office_email')))
    {
        $isValid = false;
        $f3->set("errors['office_email']", "Please enter a valid email address");
    }
    if (!validOfficePhone($f3->get('office_phone')))
    {
        $isValid = false;
        $f3->set("errors['office_phone']", "Please enter a phone number, must be 10 digits");
    }

    return $isValid;
}



/**
 * Checks if the name given was valid
 * @param String $office the name of office given
 * @return bool if the name was valid
 */
function validOffice($office)
{
    return !empty($office) && !ctype_digit($office);
}


/**
 * Checks if the email is valid
 * @param String $email the email given
 * @return bool if the email was valid ot not
 */

function validOfficeEmail($email)
{

    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * check to see that the phone number is valid
 * @param $phone
 * @return bool
 */
function validOfficePhone($phone)
{
    //eliminate every char except 0-9
    $justNums = preg_replace("/[^0-9]/", '', $phone);

    //if we have 10 digits left, it's probably valid.
    return strlen($justNums) == 10;
}

/**
 * checks if the message is valid, can't be empty
 * @param $comments String $message the message given
 * @return bool if the message was valid or not
 */
function validComments($comments)
{
    return !empty($comments);
}

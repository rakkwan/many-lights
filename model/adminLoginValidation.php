<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 11/2/2019
 * Time: 9:35 AM
 */

function validAdminLogin()
{
    global $f3;
    $isValid = true;

    if (!validAdminEmail($f3->get('adminEmail')))
    {
        $isValid = false;
        $f3->set("errors['adminEmail']", "This email is invalid or already exists, please enter a valid email address");

    }

    if (!validPassword($f3->get('adminPassword')))
    {
        $isValid = false;
        $f3->set("errors['adminPassword']", "Please enter a valid password");
    }
    return $isValid;
}


/**
 * Checks if the email is valid
 * @param Spring $adminEmail the email given
 * @return bool if the email is valid or not
 */
function validAdminEmail($adminEmail)
{
    global $db;
    $adminEmailValid = $db->checkEmail($adminEmail);
    if (empty($adminEmailValid))
    {
        return !empty($adminEmail) && filter_var($adminEmail, FILTER_VALIDATE_EMAIL);
    }
    return false;
}

/**
 * Checks if password is valid
 * @param String $password the password given
 * @return bool if the password is 7 charaters or longer
 */
function validPassword($password)
{
    return !empty($password) && strlen($password) >= 7;
}

/**
 * Check if the passwords give match
 * @param String $password the first password
 * @param String $password1 the second password
 * @return bool checks if the passwords match or not
 */
function validSamePass($password, $password1)
{
    if (!empty($password) == !empty($password1))
    {
        return $password == $password1;
    }
    return false;
}


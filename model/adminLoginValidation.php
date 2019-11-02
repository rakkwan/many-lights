<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 11/2/2019
 * Time: 9:35 AM
 */


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


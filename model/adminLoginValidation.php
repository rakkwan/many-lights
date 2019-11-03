<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 11/2/2019
 * Time: 9:35 AM
 */


/**
 * used to valid the new passwords
 * @return bool- if the new passwords are valid
 */
function validNewPassword()
{
    global $f3;
    $isValid = true;

    if (!validPassword($f3->get('newPassword')))
    {
        $isValid = false;
        $f3->set("errors['newPassword']", "Please enter a valid password, at least 7 characters");
    }

    if (!validSamePass($f3->get('newPassword'), $f3->get('newPassword1')))
    {
        $isValid = false;
        $f3->set("errors['newPassword1']", "Password must be matched, please re-enter your password");
    }

    return $isValid;
}


/**
 * used to valid the adminLogin form
 * @return bool - checks if everything is valid
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
 * @param String $adminEmail the email given
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
 * Check if the new passwords give match
 * @param String $newPassword the first password
 * @param String $newPassword1 the second password
 * @return bool checks if the passwords match or not
 */
function validSamePass($newPassword, $newPassword1)
{
    if (!empty($newPassword) == !empty($newPassword1))
    {
        return $newPassword == $newPassword1;
    }
    return false;
}


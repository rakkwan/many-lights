<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 11/18/2019
 * Time: 5:47 PM
 */

/**
 * Class AddAdmin
 * @author Jittima Goodrich
 * @copyright 11/18/2019
 */
class AddAdmin
{
    private $_fname;
    private $_lname;
    private $_email;
    private $_password;
    private $_adminType;
    /**
     * User constructor.
     * @param String $fname the first name of the admin
     * @param String $lname the last name of the admin
     * @param String $email the email of the admin
     * @param String $password the password of the admin
     * @param boolean $adminType the type of admin of the admin
     * @return void
     */
    public function __construct($email, $password, $adminType, $fname, $lname)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_password = $password;
        $this->_adminType = $adminType;
    }
    /**
     * The getter for the first name
     * @return String the first name of the admin
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * The setter for the first name
     * @param String $fname first name
     * @return void
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Gets the last name of the admin
     * @return String last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets the last name for the admin
     * @param String $lname last name
     * @return void
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Gets the email of the admin
     * @return String email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets the email for the admin
     * @param String $email the email
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Gets the password of the admin
     * @return String the password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Sets the password for the admin
     * @param String $password the password
     * @return void
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Gets the type of the admin
     * @return boolean
     */
    public function getAdminType()
    {
        return $this->_adminType;
    }

    /**
     * Sets the type of the admin
     * @param boolean $adminType
     */
    public function setAdminType($adminType)
    {
        $this->_adminType = $adminType;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/22/2019
 * Time: 5:04 PM
 */


/**
 * Class RecommendedInfo - hold info of the user who recommended the resource
 * @author Jittima Goodrich
 * @copyright 10/22/2019
 */
class RecommendedInfo
{
    private $_fname;
    private $_lname;
    private $_email;
    private $_phone;

    /**
     * RecommendedInfo constructor.
     * @param $_fname String first name
     * @param $_lname String last name
     * @param $_email String email address
     * @param $_phone String phone number
     */
    public function __construct($_fname, $_lname, $_email, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
        $this->_phone = $_phone;
    }

    /**
     * Getter for first name
     * @return mixed - first name
     */
    public function getFname()
    {
        return $this->_fname;
    }


    /**
     * Getter for the last name
     * @return mixed - last name
     */
    public function getLname()
    {
        return $this->_lname;
    }


    /**
     * Getter for the email
     * @return mixed - email
     */
    public function getEmail()
    {
        return $this->_email;
    }


    /**
     * Getter for the phone number
     * @return mixed - phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

}
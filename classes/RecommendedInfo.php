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
     * @param $fname String first name
     * @param $lname String last name
     * @param $email String email address
     * @param $phone String phone number
     */
    public function __construct($fname, $lname, $email, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_phone = $phone;
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
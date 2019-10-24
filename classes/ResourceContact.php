<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/24/2019
 * Time: 2:22 PM
 */


/**
 * Class ResourceContact - resource information
 * @author Jittima Goodrich
 * @copyright 10/24/2019
 */
class ResourceContact
{
    private $_service;
    private $_specialty;
    private $_office;
    private $_officePhone;
    private $_officeEmail;
    private $_theraFname;
    private $_theraLname;
    private $_theraGender;


    /**
     * ResourceContact constructor.
     * @param $service - type of service
     * @param $specialty - specify specialty
     * @param $office - name of the place
     * @param $officePhone - office phone number
     * @param $officeEmail - office email address
     * @param $theraFname - therapist first name
     * @param $theraLname - therapist last name
     * @param $theraGender - therapist gender
     */
    function __construct($service, $specialty, $office, $officePhone, $officeEmail, $theraFname, $theraLname, $theraGender)
    {
        $this->_service = $service;
        $this->_specialty = $specialty;
        $this->_office = $office;
        $this->_officePhone = $officePhone;
        $this->_officeEmail = $officeEmail;
        $this->_theraFname = $theraFname;
        $this->_theraLname = $theraLname;
        $this->_theraGender = $theraGender;
    }

    /**
     * Getter for service
     * @return mixed
     */
    public function getService()
    {
        return $this->_service;
    }

    /**
     * Getter for specialty
     * @return mixed
     */
    public function getSpecialty()
    {
        return $this->_specialty;
    }

    /**
     * Getter for office name
     * @return mixed
     */
    public function getOffice()
    {
        return $this->_office;
    }

    /**
     * Getter for office phone number
     * @return mixed
     */
    public function getOfficePhone()
    {
        return $this->_officePhone;
    }

    /**
     * Getter for office email address
     * @return mixed
     */
    public function getOfficeEmail()
    {
        return $this->_officeEmail;
    }

    /**
     * Getter for therapist first name
     * @return mixed
     */
    public function getTheraFname()
    {
        return $this->_theraFname;
    }

    /**
     * Getter for therapist last name
     * @return mixed
     */
    public function getTheraLname()
    {
        return $this->_theraLname;
    }

    /**
     * Getter for therapist Gender
     * @return mixed
     */
    public function getTheraGender()
    {
        return $this->_theraGender;
    }


}
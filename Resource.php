<?php
/**
 * Created by PhpStorm.
 * User: samantha
 * Date: 2019-10-30
 * Time: 23:21
 */

class Resource
{
    private $service, $theraFname, $theraLname, $officePhone, $countyOne, $countyTwo,
        $countyThree, $officeEmail, $address, $city, $zip, $state;

    /**
     * Resource constructor.
     * @param $service
     * @param $theraFname
     * @param $theraLname
     * @param $officePhone
     * @param $countyOne
     * @param $countyTwo
     * @param $countyThree
     * @param $officeEmail
     * @param $address
     * @param $city
     * @param $zip
     * @param $state
     */
    public function __construct($service, $theraFname, $theraLname, $officePhone, $countyOne, $countyTwo, $countyThree, $officeEmail, $address, $city, $zip, $state)
    {
        $this->service = $service;
        $this->theraFname = $theraFname;
        $this->theraLname = $theraLname;
        $this->officePhone = $officePhone;
        $this->countyOne = $countyOne;
        $this->countyTwo = $countyTwo;
        $this->countyThree = $countyThree;
        $this->officeEmail = $officeEmail;
        $this->address = $address;
        $this->city = $city;
        $this->zip = $zip;
        $this->state = $state;
    }


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->service . "is " . $this->theraFname;
    }
}
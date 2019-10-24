<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/24/2019
 * Time: 3:45 PM
 */



/**
 * Class LocationForm - optional location information of resource
 * @author Jittima Goodrich
 * @copyright 10/24/2019
 */
class LocationForm
{
    private $_address;
    private $_city;
    private $_state;
    private $_zip;
    private $_website;


    /**
     * LocationForm constructor.
     * @param $address - Street address for the resource
     * @param $city - city it's located
     * @param $state - state its located
     * @param $zip - zip code its located
     * @param $website - website of the resource
     */
    function __construct($address, $city, $state, $zip, $website)
    {
        $this->_address = $address;
        $this->_city = $city;
        $this->_state = $state;
        $this->_zip = $zip;
        $this->_website = $website;
    }

    /**
     * Getter that gets the address
     * @return mixed
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * Getter that gets the city
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * Getter that gets the state
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Getter that gets the zip code
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * Getter that gets the website
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->_website;
    }


}
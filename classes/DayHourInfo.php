<?php


class DayHourInfo
{
    private $_day;
    private $_fromTime;
    private $_toTime;
    private $_countyOne;
    private $_countyTwo;
    private $_countyThree;

    function __construct($_day, $_countyOne, $_countyTwo, $_countyThree)
    {
        $this->_day = $_day;
//        $this->_fromTime;
//        $this->_toTime;
        $this->_countyOne = $_countyOne;
        $this->_countyTwo = $_countyTwo;
        $this->_countyThree = $_countyThree;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->_day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->_day = $day;
    }

    public function containsDay($day)
    {
    foreach ($this->_day as $value)
    {
        if($value == $day)
        {
        return true;
        }
    }
        return false;
    }

    /**
     * @return mixed
     */
    public function getFromTime()
    {
        return $this->_fromTime;
    }

    /**
     * @param mixed $fromTime
     */
    public function setFromTime($fromTime)
    {
        $this->_fromTime = $fromTime;
    }

    /**
     * @return mixed
     */
    public function getToTime()
    {
        return $this->_toTime;
    }

    /**
     * @param mixed $toTime
     */
    public function setToTime($toTime)
    {
        $this->_toTime = $toTime;
    }

    /**
     * @return mixed
     */
    public function getCountyOne()
    {
        return $this->_countyOne;
    }

    /**
     * @param mixed $countyOne
     */
    public function setCountyOne($countyOne)
    {
        $this->_countyOne = $countyOne;
    }

    /**
     * @return mixed
     */
    public function getCountyTwo()
    {
        return $this->_countyTwo;
    }

    /**
     * @param mixed $countyTwo
     */
    public function setCountyTwo($countyTwo)
    {
        $this->_countyTwo = $countyTwo;
    }

    /**
     * @return mixed
     */
    public function getCountyThree()
    {
        return $this->_countyThree;
    }

    /**
     * @param mixed $countyThree
     */
    public function setCountyThree($countyThree)
    {
        $this->_countyThree = $countyThree;
    }


}
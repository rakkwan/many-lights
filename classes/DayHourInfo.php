<?php


class DayHourInfo
{
    private $_day;
    private $_fromTime;
    private $_toTime;
    private $_county1;
    private $_county2;
    private $_county3;

    function __construct($_day, $_county1, $_county2, $_county3)
    {
        $this->_day;
        $this->_fromTime;
        $this->_toTime;
        $this->_county1;
        $this->_county2;
        $this->_county3;
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
        return false;
    }
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
    public function getCounty1()
    {
        return $this->_county1;
    }

    /**
     * @param mixed $county1
     */
    public function setCounty1($county1)
    {
        $this->_county1 = $county1;
    }

    /**
     * @return mixed
     */
    public function getCounty2()
    {
        return $this->_county2;
    }

    /**
     * @param mixed $county2
     */
    public function setCounty2($county2)
    {
        $this->_county2 = $county2;
    }

    /**
     * @return mixed
     */
    public function getCounty3()
    {
        return $this->_county3;
    }

    /**
     * @param mixed $county3
     */
    public function setCounty3($county3)
    {
        $this->_county3 = $county3;
    }


}
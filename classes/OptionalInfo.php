<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 10/23/2019
 * Time: 1:56 PM
 */


/**
 * Class OptionalInfo represents optional information
 *
 * @author Jittima Goodrich
 * @copyright 10/23/2019
 */
class OptionalInfo
{
    private $_age;
    private $_interpreter;
    private $_insurance;
    private $_fee;

    /**
     * OptionalInfo constructor.
     * @param $age - ages seen
     * @param $interpreter - language
     * @param $insurance - insurance accepted
     * @param $fee - fee charge
     */
    function __construct($age, $interpreter, $insurance, $fee)
    {
        $this->_age = $age;
        $this->_interpreter = $interpreter;
        $this->_insurance = $insurance;
        $this->_fee = $fee;
    }

    /**
     * Getter that gets age
     * @return mixed
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Setter that sets the age
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Getter that gets the interpreter
     * @return mixed
     */
    public function getInterpreter()
    {
        return $this->_interpreter;
    }

    /**
     * Setter that sets the interpreter
     * @param mixed $interpreter
     */
    public function setInterpreter($interpreter)
    {
        $this->_interpreter = $interpreter;
    }

    /**
     * Getter that gets insurance
     * @return mixed
     */
    public function getInsurance()
    {
        return $this->_insurance;
    }

    /**
     * Setter that sets insurance
     * @param mixed $insurance
     */
    public function setInsurance($insurance)
    {
        $this->_insurance = $insurance;
    }

    /**
     * Getter that gets fee
     * @return mixed
     */
    public function getFee()
    {
        return $this->_fee;
    }

    /**
     * Setter that sets fee
     * @param mixed $fee
     */
    public function setFee($fee)
    {
        $this->_fee = $fee;
    }


}
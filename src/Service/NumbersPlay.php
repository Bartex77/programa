<?php

namespace App\Service;

/**
 * Class NumbersPlay
 * @package App\Service
 *
 * Just a bit of fun with numbers
 */
class NumbersPlay
{
    const EVEN_BIGGER = 1;
    const EVEN_LESS = -1;
    const EQUAL = 0;

    /**
     * @var int Number of even numbers
     */
    private $even = 0;

    /**
     * @var int Number of odd numbers
     */
    private $odd = 0;

    /**
     * NumbersPlay constructor.
     *
     * @param $even
     * @param $odd
     *
     * @throws \Exception
     */
    public function __construct($even, $odd) {
        if ($even < 0 || $odd < 0) {
            throw new \Exception('Both numbers must not be negative!');
        }

        $this->even = $even;
        $this->odd = $odd;
    }

    /**
     * @param $number
     *
     * @throws \Exception
     */
    public function acceptNumber($number) {
        if ($number < 0) {
            throw new \Exception('Only natural numbers!');
        }

        $this->isEven($number) ? $this->even++ : $this->odd++;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    private function isEven($number) {
        if ( ($number % 2) == 0 ) {
            // yes, I know - zero could be on the left, but I think it's quite pretentious coding style
            // extra brackets are "just in case"
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function result() {
        $even = 3 * $this->even;
        $odd = 2 * $this->odd;

        return ($even == $odd) ? self::EQUAL : ($even > $odd ? self::EVEN_BIGGER : self::EVEN_LESS);
    }
}

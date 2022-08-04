<?php namespace AlexDev\Alexander\Core;

/**
 * Enum for manage state of command
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 */
enum Status : int {
    case Success = 0;
    case Failure = 1;
    case Invalid = 2;

    //-----------------------------------------------------------------------

    /**
     * Get status value
     *
     * @return int
     */
    public function getValue() : int {
        return $this->value;
    }

    //-----------------------------------------------------------------------
}
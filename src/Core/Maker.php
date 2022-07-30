<?php namespace AlexDev\Alexander\Core;

/**
 * Class for make singleton class
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 */
class Maker {

    /**
     * Contains istances
     *
     * @access private
     *
     * @static
     *
     * @var object[]
     */
    private static $instances = [];

    //-----------------------------------------------------------------------

    /**
     * Get istance and create istance if not exist
     *
     * @access public
     *
     * @static
     *
     * @return object
     */
    public static function make(string $class) {

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }

        return self::$instances[$class];
    }

    //-----------------------------------------------------------------------
}
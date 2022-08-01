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
     * @param string|object $istance    Istance to get
     *
     * @return object
     */
    public static function make(string|object $istance) : object {

        $namespace = is_object($istance) ? self::makeByObject($istance) : self::makeByNamespace($istance);

        return self::getIstance($namespace);
    }

    //-----------------------------------------------------------------------

    /**
     * Get istance by namespace
     *
     * @access private
     *
     * @static
     *
     * @param string $namespace     Istance namespace
     *
     * @return object
     */
    private static function getIstance(string $namespace) : object {
        return self::$instances[$namespace];
    }

    //-----------------------------------------------------------------------

    /**
     * Make a istance if passed a object
     *
     * @access private
     *
     * @static
     *
     * @param object $istance
     *
     * @return string   Namespace istance
     */
    private static function makeByObject(object $istance) : string {

        if (!isset(self::$instances[$istance::class])) {
            self::$instances[$istance::class] = $istance;
        }

        return $istance::class;
    }

    //-----------------------------------------------------------------------

    /**
     * Make a istance if passed a istance with namespace
     *
     * @access private
     *
     * @static
     *
     * @param object $istance
     *
     * @return string   Namespace istance
     */
    private static function makeByNamespace (string $istance) : string {

        if (!isset(self::$instances[$istance])) {
            self::$instances[$istance] = new $istance;
        }

        return $istance;
    }

    //-----------------------------------------------------------------------
}
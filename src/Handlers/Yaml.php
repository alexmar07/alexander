<?php namespace AlexDev\Alexander\Handlers;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

/**
 * Class for manage local file YAML for
 * manage application
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 *
 * @since v1.0.0
 */
class Yaml {

    /**
     * Path local file
     *
     * @access private
     *
     * @static
     *
     * @var string
     */
    private static string $path;

    //-----------------------------------------------------------------------

    /**
     * Construct
     *
     */
    public function __construct() {

        // Set path
        self::$path = local_path().DIRECTORY_SEPARATOR;
    }

    //-----------------------------------------------------------------------

    /**
     * Check if file yaml exist
     *
     * @param string $filename
     *
     * @return bool
     */
    public static function exist (string $filename) : bool {
        return file_exists(self::getFullPath($filename));
    }

    //-----------------------------------------------------------------------

    /**
     * Convert file yaml in array if file exist
     *
     * @access public
     *
     * @static
     *
     * @param string $filename
     *
     * @return array|false FALSE if file not exist
     */
    public static function load (string $filename) : array|false {

        if ( ! self::exist($filename) ) return false;

        return SymfonyYaml::parseFile(self::getFullPath($filename));
    }

    //-----------------------------------------------------------------------

    /**
     * Write a file yaml
     *
     * @access public
     *
     * @static
     *
     * @param string $filename
     * @param array $data   Data to write into a file
     *
     * @return void
     */
    public static function write (string $filename, array $data) : void {

        $yaml = SymfonyYaml::dump($data);

        file_put_contents(self::getFullPath($filename), $yaml);
    }

    //-----------------------------------------------------------------------

    /**
     * Return full path file
     *
     * @access private
     *
     * @static
     *
     * @param string $filename
     *
     * @return string
     */
    private static function getFullPath (string $filename) : string {
        return self::$path.$filename.'.yml';
    }
}
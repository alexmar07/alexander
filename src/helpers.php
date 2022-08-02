<?php

use AlexDev\Alexander\Core\Maker;
use AlexDev\Alexander\Handlers\Translator;


if ( ! function_exists('load_config') ) {

    /**
     * Load configuration file
     *
     * @param string $file
     *
     * @return array
     */
    function load_config(string $file = 'config') : array {
        return require base_path()."/config/{$file}.php";
    }
}

//-----------------------------------------------------------------------

if ( ! function_exists('make') ) {

    /**
     * Use Maker for get instance
     *
     * @param string $class
     *
     * @return object
     */
    function make(string|Object $class) {

        $istance = Maker::make($class);

        return $istance;
    }
}

//-----------------------------------------------------------------------

if ( ! function_exists('trans') ) {

    /**
     * Get translation
     *
     * @return string
     */
    function trans(string $key, array $params = []) : string {
        return make(Translator::class)->trans($key, $params);
    }
}

//-----------------------------------------------------------------------


if ( ! function_exists('resource_path') ) {

    /**
     * Get path of resources files
     *
     * @return string|null
     */
    function resource_path () : string {

        $path = load_config('paths');

        return $path['resources'];
    }
}

//-----------------------------------------------------------------------

if ( ! function_exists('local_path') ) {

    /**
     * Get path of local files
     *
     * @return string
     */
    function local_path () : string {

        $path = load_config('paths');

        return $path['local'];
    }
}

//-----------------------------------------------------------------------


if ( ! function_exists('base_path') ) {

    /**
     * Get root path
     *
     * @return string|null
     */
    function base_path () : string {
        return dirname(__DIR__).'/src';
    }
}

//-----------------------------------------------------------------------


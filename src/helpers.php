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
    function load_config(string $file) : array {
        return require __DIR__."/config/{$file}.php";
    }
}

if ( ! function_exists('make') ) {

    /**
     * Use Maker for get instance
     *
     * @param string $class
     *
     * @return object
     */
    function make(string $class) {

        $istance = Maker::make($class);

        return $istance;
    }
}

if ( ! function_exists('trans') ) {

    /**
     * Get translation
     *
     * @return string
     */
    function trans(string $key) : string {
        return make(Translator::class)->trans($key);
    }
}

if ( ! function_exists('resource_path') ) {

    /**
     * Get path of resources files
     *
     * @return string|null
     */
    function resource_path () : ?string {

        $path = load_config('paths');

        return $path['resource'] ?? null;
    }
}
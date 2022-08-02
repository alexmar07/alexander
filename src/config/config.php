<?php

/**
 * Config application
 *
 */

use AlexDev\Alexander\Commands\ConfigureCommand;
use AlexDev\Alexander\Commands\GetEnvCommand;

return [

    /**
     * List commands
     *
     */
    'commands'  => [
        ConfigureCommand::class,
        GetEnvCommand::class
    ],

];
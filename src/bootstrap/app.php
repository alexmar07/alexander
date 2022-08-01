<?php

use AlexDev\Alexander\Alexander;

require __DIR__.'/../../vendor/autoload.php';

$alexander = make(new Alexander(dirname(__DIR__)));

$alexander->loadEnv();

return $alexander;
<?php namespace AlexDev\Alexander;

use Symfony\Component\Console\Application;

class Alexander {

    private Application $app;

    public function __construct() {

        $this->app = new Application($this->name(), $this->version());
    }

    public function name() : string {
        return 'Alexander';
    }

    public function version () : string {
        return 'v1.0.0';
    }

    public function run () : int {
        return $this->app->run();
    }

    public function registerCommand(string $command) : void {
        $this->app->add(new $command);
    }

    protected function bootConfig() {

        $config = require __DIR__.'/config/config.php';

        foreach (array_keys($config) as $key) {

            $this->config->{$key} = $config[$key];
        }
    }

    protected function bootCommand () : void {

        if ( ! isset($this->config->commands) || empty($this->config->commands) ) return;

        foreach ($this->config->commands as $command) {

            if ( ! class_exists($command) ) continue;

            $this->registerCommand($command);
        }

    }
}
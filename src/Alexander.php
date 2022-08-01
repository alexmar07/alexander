<?php namespace AlexDev\Alexander;

use Dotenv\Dotenv;
use Symfony\Component\Console\Application;

/**
 * Main application starter
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 *
 * @since v1.0.0
 */
class Alexander {

    /**
     * Consolo application client
     *
     * @access private
     *
     * @var Application
     */
    private Application $app;

    /**
     * Configuration
     *
     * @access private
     *
     * @var array|null
     */
    protected ?array $config = null;

    /**
     * Path root of project
     *
     * @access public
     *
     * @readonly
     *
     * @var string
     */
    public readonly string $basePath;

    //-----------------------------------------------------------------------

    /**
     * Constructor
     *
     * @param string $basePath  Base path application
     *
     */
    public function __construct(string $basePath) {

        $this->app = new Application($this->name(), $this->version());

        $this->basePath = $basePath;

        $this->bootConfig();
        $this->bootCommands();
    }

    //-----------------------------------------------------------------------

    /**
     * Get application name
     *
     * @access public
     *
     * @return string
     */
    public function name() : string {
        return 'Alexander';
    }

    //-----------------------------------------------------------------------

    /**
     * Get current application version
     *
     * @access public
     *
     * @return string
     */
    public function version () : string {
        return 'v1.0.0';
    }

    //-----------------------------------------------------------------------

    /**
     * Lauch command
     *
     * @access public
     *
     * @return int
     */
    public function run () : int {
        return $this->app->run();
    }

    //-----------------------------------------------------------------------

    /**
     * Register a command
     *
     * @access protected
     *
     * @param string $command
     *
     * @return void
     */
    protected function registerCommand(string $command) : void {
        $this->app->add(new $command);
    }

    //-----------------------------------------------------------------------

    /**
     * Boot configurations
     *
     * @access protected
     *
     * @return void
     */
    protected function bootConfig() {

        $config = load_config();

        foreach (array_keys($config) as $key) {

            $this->config[$key] = $config[$key];

        }
    }

    //-----------------------------------------------------------------------

    /**
     * Boot commands
     *
     * @access protected
     *
     * @return void
     */
    protected function bootCommands () : void {

        if ( ! isset($this->config['commands']) || empty($this->config['commands']) ) return;

        foreach ($this->config['commands'] as $command) {

            if ( ! class_exists($command) ) continue;

            $this->registerCommand($command);
        }

    }

    //-----------------------------------------------------------------------

    /**
     * Load environment vars
     *
     * @access public
     *
     * @return void
     */
    public  function loadEnv() : void {

        $dotenv = Dotenv::createUnsafeImmutable($this->basePath.'/..');;
        $dotenv->safeLoad();

    }
}
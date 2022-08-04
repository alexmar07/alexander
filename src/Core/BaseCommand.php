<?php namespace AlexDev\Alexander\Core;

use AlexDev\Alexander\Core\Status;
use AlexDev\Alexander\Handlers\Yaml;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic command configuration
 *
 * @abstract
 *
 * @author Alessandro Marotta <alessand.marotta@gmail.com>
 */
abstract class BaseCommand extends Command {

    /**
     * Input for use option and args
     *
     * @access protected
     *
     * @var InputInterface
     */
    protected InputInterface $input;

    /**
     * Output for write messages and result
     *
     * @access protected
     *
     * @var OutputInterface
     */
    protected OutputInterface $output;

    /**
     * Use for check if environment exists
     *
     * @access protected
     *
     * @var bool
     */
    protected bool $useEnv = true;

    /**
     * Array with environment
     *
     * @access protected
     *
     * @var array|null
     */
    protected ?array $env = null;

    //-----------------------------------------------------------------------

    /**
     * Construct
     *
     */
    public function __construct() {
        parent::__construct();
    }

    //-----------------------------------------------------------------------

    /**
     * {@inheritDoc}
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output): int {

        $yaml = make(Yaml::class);

        // Check if environment.yml exists
        if ( ! $yaml->exist('environment') && $this->useEnv  ) {
            $output->writeln(trans('environment_not_exist'));

            return (Status::Invalid)->getValue();
        }

        $this->env = $this->useEnv ? $yaml->load('environment') : null;

        $this->input = $input;
        $this->output = $output;

        // Use handler function for get result command
        return $this->handle()->getValue();
    }

    //-----------------------------------------------------------------------

    /**
     * Execute command
     *
     * @abstract
     *
     * @access protected
     *
     * @return Status
     */
    abstract protected function handle() : Status;
}

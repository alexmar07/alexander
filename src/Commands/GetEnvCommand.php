<?php namespace AlexDev\Alexander\Commands;

use AlexDev\Alexander\Core\Status;
use AlexDev\Alexander\Core\BaseCommand;
use Symfony\Component\Console\Helper\Table;

/**
 * Show tables with environment values
 *
 * @extends BaseCommand
 */
class GetEnvCommand extends BaseCommand {

    protected static $defaultName = 'core:get-env';

    protected static $defaultDescription = 'Show local environment';

    protected function handle() : Status {

        // Create table instance
        $table = new Table($this->output);

        $table->setHeaderTitle('Environment');

        // Set table values
        $table->setHeaders(array_keys($this->env))
            ->setRows([array_values($this->env)]);

        // Show table
        $table->render();

        return Status::Success;
    }
}
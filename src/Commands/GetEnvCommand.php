<?php namespace AlexDev\Alexander\Commands;

use AlexDev\Alexander\Handlers\Yaml;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetEnvCommand extends Command {

    protected static $defaultName = 'core:get-env';

    protected static $defaultDescription = 'Show local environment';

    protected function execute(InputInterface $input, OutputInterface $output): int {

        $yaml = make(Yaml::class);

        if ( ($enviroment = $yaml->load('environment')) === false ) {
            $output->writeln(trans('environment_not_exist'));
        }
        else {

            $table = new Table($output);

            $table->setHeaderTitle('Environment');

            $table->setHeaders(array_keys($enviroment))
                ->setRows([array_values($enviroment)]);

            $table->render();
        }

        return Command::SUCCESS;
    }
}
<?php namespace AlexDev\Alexander\Commands;

use AlexDev\Alexander\Handlers\Yaml;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class ConfigureCommand extends Command {

    protected static $defaultName = 'core:configure';

    protected static $defaultDescription = 'Configure Alexander for usage';

    protected function execute(InputInterface $input, OutputInterface $output): int {

        $yaml = make(Yaml::class);

        $helper = $this->getHelper('question');

        // Check if environment file exist
        if ( $yaml->exist('environment') ) {

            $question = new ConfirmationQuestion(
                trans('confirm_environment_overwrite'),
                true
            );

            if ( ! $helper->ask($input, $output, $question)) {

                $output->writeln(trans('no_envirnoment_overwrite'));

                return Command::SUCCESS;
            }

        }

        $environmet = [];

        // Add user
        $question = new Question(trans('question_environment_user'), null);

        $user = $helper->ask($input, $output, $question);

        while ( is_null($user) ) {

            $output->writeln(trans('environment_user_not_setting'));
            $user = $helper->ask($input, $output, $question);
        }

        $environmet['LOCAL_USER'] = $user;

        // Choice lang
        $question = new ChoiceQuestion(
            trans('question_environment_lang'),
            ['it_IT', 'en_EN'],
            'it_IT'
        );

        $lang = $helper->ask($input, $output, $question);

        $environmet['APP_LOCALE'] = $lang;

        // Write config
        $yaml->write('environment', $environmet);

        $output->writeln(trans('complete_environment_configuration', ['%user%' => $environmet['LOCAL_USER']]));

        return Command::SUCCESS;
    }
}
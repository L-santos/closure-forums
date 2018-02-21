<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ConfirmationQuestion;
/**
 * @author Lucas Santos <devlostpublisher@gmail.com>
 * 
 * @todo Install script
 */
class ClosureInstallCommand extends Command
{
    protected static $defaultName = 'closure:install';

    protected function configure()
    {
        $this
            ->setDescription('closure-forums installation')
            ->setHelp('Bootstrap a new forum');
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');

        $query_command = $this->getApplication()->find('doctrine:query:sql');
        $import_command = $this->getApplication()->find('doctrine:database:import');
        $create_command = $this->getApplication()->find('doctrine:database:create');
        $migrate_command = $this->getApplication()->find('doctrine:migrations:migrate');

        $file = file_get_contents('sql/install.sql');
        $sql = explode('--', $file);

        $output->writeln([
            'Closure-Forums',
            '======================',
            'This script bootstraps a new forum, make sure you delete it after finishing',
            'Please create the database and set the connection string in the .env file before running this script',
            '======================',
            ''
        ]);

        $schema_question = new ConfirmationQuestion('The script will CREATE the database schema, any data in the database will be lost. Continue? (y/n): ', false);
        $conf_question = new ConfirmationQuestion('The script will write into the database, any data in the database will be lost. Continue? (y/n): ', false);
        $user_question = new Question('Forum admin username (Default is admin): ', 'admin');
        $pswd_question = new Question('Password for admin user: ');

        /**
         * Create Schema & Data
         */
        if(!$helper->ask($input, $output, $schema_question)) return;
        $output->writeln('Creating Schema');
        //Create schema
        $args = [
            'command' => 'doctrine:databas:import',
            'file' => 'sql/schema.sql'
        ];
        $import_command->run(new ArrayInput($args), $output);

        //Add base data
        $argv = [
            'command' => 'doctrine:query:sql',
            'sql' => $sql[0]
        ];
        $query_command->run(new ArrayInput($argv), $output);
        $helper->ask($input, $output, new Question('Press Enter to continue...'));

        //Create Admin
        $username = $helper->ask($input, $output, $user_question);
        $password = $helper->ask($input, $output, $pswd_question);
        $def_password = password_hash('123456', PASSWORD_BCRYPT);

        if(!$password) {
            $output->writeln('You must provide a password. Try again.'); 
            return;
        }

            $output->writeln('Working...');
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);
            $sql_a = "INSERT INTO user (status_id,roles, created_at, reported, username, password)
            VALUES (1, '[\"ROLE_ADMIN\"]', now(), 0, '$username', '".$password_hashed."'),
            (2, '[\"ROLE_USER\"]', now(), 0, 'user', '".$def_password."'),
            (2, '[\"ROLE_USER\"]', now(), 0, 'mod', '".$def_password."')";             
            //Create the user
            $query = $query_command->run(
                new ArrayInput([
                    'command' => 'doctrine:query:sql',
                    'sql' => $sql_a
                ]) , $output);
                
            $query_command->run(
                new ArrayInput([
                    'command' => 'doctrine:query:sql', 
                    'sql' => $sql[1]
                ]), $output
            );
    }
}

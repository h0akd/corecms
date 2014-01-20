<?php

namespace H0akd\Corecms\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use H0akd\Corecms\Models\AdminUser;

class SeedCommand extends Command {

    protected $name = 'corecms:seed';
    protected $description = 'Create user for core cms';

    public function fire() {
        if (!Schema::hasTable('uses')) {
            $this->error("Table users not exist");
            return;
        }

        $email = $this->argument("email");
        $password = $this->argument("password");
        $firstname = $this->option("firstname");
        $lastname = $this->option("lastname");

        $user = new AdminUser();
        $user->email = $email;
        $user->password = $password;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->is_admintrator = $this->option("admintrator");
        $user->save();
    }

    protected function getArguments() {
        return array(
            array('email', InputArgument::REQUIRED, 'Email for users'),
            array('password', InputArgument::REQUIRED, 'Pasword for users'),
        );
    }

    protected function getOptions() {
        return array(
            array('--admintrator', null, InputOption::VALUE_NONE, 'Set user is admintrator.', null),
            array('--firstname', "", InputOption::VALUE_REQUIRED, 'Set user first name.', null),
            array('--lastname', "", InputOption::VALUE_REQUIRED, 'Set user lastname.', null),
        );
    }

}

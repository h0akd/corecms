<?php

namespace H0akd\Corecms\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command {

    protected $name = 'corecms:install';
    protected $description = 'Quick install corecms';

    public function fire() {
        $this->call("asset:publish", array("package" => "h0akd/corecms"));
        $this->call("config:publish", array("package" => "h0akd/corecms"));
        $this->call("config:publish", array("package" => "cartalyst/sentry"));
        $this->call("migrate", array("--package" => "cartalyst/sentry"));
        $this->call("migrate", array("--package" => "h0akd/corecms"));
    }

}

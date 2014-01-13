<?php

namespace H0akd\Corecms\Facades;

use Illuminate\Support\Facades\Facade;

class UserConfiguaration extends Facade {

    protected static function getFacadeAccessor() {
        return "userconfig";
    }

}

<?php

namespace H0akd\Corecms\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model {

    protected $table = 'users';
    protected $hidden = array('password');

}

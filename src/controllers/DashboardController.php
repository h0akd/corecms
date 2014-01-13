<?php

namespace H0akd\Corecms\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
class DashboardController extends Controller {

    public function index() {
        return View::make("CoreCms::home.dashboard");
    }

}

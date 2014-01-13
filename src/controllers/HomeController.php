<?php

namespace H0akd\Corecms\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class HomeController extends Controller {

    public function index() {
        return View::make("CoreCms::home.index");
    }

    /**
     * Get side navigation view content
     * @return View 
     */
    public function sidenav() {
        $user = Sentry::getUser();
        $admintrator = Sentry::findGroupByName('admintrator');
        if (!$user->inGroup($admintrator)) {
            $modules = $this->getUserModules($user, false);
        } else {
            $modules = array_merge($this->getSystemModules(), $this->getUserModules($user, true));
        }
        return View::make("CoreCms::layouts.partial.navside")
                        ->with("systems", $modules);
    }

    /**
     * Get top navigation view content
     * @return type
     */
    public function navbar() {
        return View::make("CoreCms::layouts.partial.navbar");
    }

    public function signin() {
        return View::make("CoreCms::home.signin");
    }

    public function authen() {
        // Gather Sanitized Input
        $input = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'rememberMe' => Input::get('rememberMe')
        );

        // Set Validation Rules
        $rules = array(
            'email' => 'required|min:4|max:255' . (($input['email'] !== "admintrator") ? "|email" : ""),
            'password' => 'required|min:6'
        );

        //Run input validation
        $v = Validator::make($input, $rules);

        if ($v->fails()) {
            // Validation has failed
            return Redirect::route('admin.signin')->withErrors($v)->withInput();
        } else {
            try {
                // Set login credentials
                $credentials = array(
                    'email' => $input['email'],
                    'password' => $input['password']
                );
                // Try to authenticate the user
                Sentry::authenticate($credentials, $input['rememberMe']);
            } catch (UserNotFoundException $e) {
                Session::flash('error', 'Invalid username or password.');
                return Redirect::route('admin.signin')->withErrors($v)->withInput();
            } catch (UserNotActivatedException $e) {
                Session::flash('error', 'You have not yet activated this account.');
                return Redirect::route('admin.signin')->withErrors($v)->withInput();
            }
            //Login was succesful.  
            return Redirect::route("admin.home");
        }
    }

    public function signout() {
        // Logs the user out
        Sentry::logout();
        return Redirect::route('admin.signin');
    }

    public function changepass() {
        
    }

    public function getSystemModules() {
        return array(
            array(
                "name" => "Cấu hình module",
                "childs" => array(
                    array("menu-title" => "Danh sách các module", "tab-title" => "Danh sách module", "url" => URL::route("admin.modules.index")),
                    array("menu-title" => "Thêm module mới", "tab-title" => "Thêm module", "url" => URL::route("admin.modules.create")),
                ),
            ),
            array(
                "name" => "Quyền quản trị",
                "childs" => array(
                    array("menu-title" => "Danh sách quyền", "tab-title" => "Danh sách quyền", "url" => URL::route("admin.permistions.index")),
                    array("menu-title" => "Thêm quyền mới", "tab-title" => "Thêm quyền", "url" => URL::route("admin.permistions.create")),
                ),
            ),
            array(
                "name" => "Nhóm quản trị viên",
                "childs" => array(
                    array("menu-title" => "Danh sách nhóm", "tab-title" => "Danh sách các nhóm", "url" => URL::route("admin.groups.index")),
                    array("menu-title" => "Thêm nhóm mới", "tab-title" => "Thêm nhóm mới", "url" => URL::route("admin.groups.create")),
                ),
            ),
            array(
                "name" => "Quản trị viên",
                "childs" => array(
                    array("menu-title" => "Danh sách quản trị viên", "tab-title" => "Danh sách admin", "url" => URL::route("admin.users.index")),
                    array("menu-title" => "Thêm quản trị viên mới", "tab-title" => "Thêm admin", "url" => URL::route("admin.users.create")),
                ),
            ),
        );
    }

    private function getUserModules($user, $admintrator) {
        $results = array();
        $modules = \H0akd\Corecms\Models\Module::all();
        foreach ($modules as $module) {
            if ($admintrator || $this->hasPermistionAccesModule($user, $module->alias)) {
                $results[] = array(
                    "name" => $module->name,
                    "childs" => json_decode($module->childs, 1),
                );
            }
        }
        return $results;
    }

    private function hasPermistionAccesModule($user, $moduleAlias) {
        $permistions = \H0akd\Corecms\Models\Permistion::all();
        foreach ($permistions as $permistion) {
            if ($user->hasAccess("$moduleAlias.$permistion->alias")) {
                return true;
            }
        }
        return false;
    }

}

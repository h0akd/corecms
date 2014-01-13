<?php

namespace H0akd\Corecms\Controllers;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use H0akd\Corecms\Models\AdminUser;
use H0akd\Corecms\Models\Group;
use H0akd\Corecms\Models\Module;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $rows = AdminUser::paginate(10);
        return View::make("CoreCms::user.listing")->with("models", $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $modules = Module::all();
        $groups = Group::all();
        return View::make("CoreCms::user.create")
                        ->with("groups", $groups)
                        ->with("modules", $modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = array(
            "email" => Input::get("email"),
            "first_name" => Input::get("first_name"),
            "last_name" => Input::get("last_name"),
            "password" => Input::get("password"),
            "repassword" => Input::get("repassword"),
            "groups" => Input::get("groups") == null ? array() : Input::get("groups"),
        );

        $rules = array(
            "email" => "required|unique:users,email",
            "first_name" => "required",
            "last_name" => "required",
            "password" => "required|min:6",
            "repassword" => "required|min:6|same:password",
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.users.create')->withErrors($validator)->withInput();
        } else {
            $user = new AdminUser();
            $user->email = $data['email'];
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->password = Hash::make($data['password']);
            if ($user->save()) {
                $s_user = Sentry::findUserById($user->id);
                foreach ($data["groups"] as $group) {
                    $s_user->addGroup(Sentry::findGroupById($group));
                }
                Session::flash('success', "Đã thêm user" . $data['email'] . " thành công");
                return Redirect::route('admin.users.create');
            } else {
                Session::flash('error', "Xảy ra lỗi trong khi thêm user " . $data['name']);
                return Redirect::route('admin.users.create');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $model = AdminUser::findOrFail($id);
        $modules = Module::all();
        $groups = Group::all();
        $usergroups = Sentry::findUserByID($id)->getGroups();
        return View::make("CoreCms::user.edit")
                        ->with("model", $model)
                        ->with("groups", $groups)
                        ->with("modules", $modules)
                        ->with("usergroups", $usergroups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = AdminUser::findOrFail($id);

        $data = array(
            "first_name" => Input::get("first_name"),
            "last_name" => Input::get("last_name"),
            "groups" => Input::get("groups") == null ? array() : Input::get("groups"),
        );

        $rules = array(
            "first_name" => "required",
            "last_name" => "required",
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.users.edit', $id)->withErrors($validator)->withInput();
        } else {
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];

            DB::delete('delete from users_groups where user_id=' . $id);
            foreach ($data['groups'] as $group) {
                DB::statement("INSERT IGNORE INTO users_groups (user_id,group_id) VALUES(?,?)", array($id, $group));
            }

            if ($user->save()) {
                Session::flash('success', "Đã cập nhật user" . $user->email . " thành công");
                return Redirect::route('admin.users.edit', $id);
            } else {
                Session::flash('error', "Xảy ra lỗi trong khi cập nhật user " . $user->email);
                return Redirect::route('admin.users.edit', $id);
            }
        }
    }

    public function handactive($id) {
        $date = new \DateTime();
        $user = AdminUser::findOrFail($id);
        $user->activated = $user->activated == 0 ? 1 : 0;
        $user->activated_at = $date;
        return json_encode($user->save() ? array("code" => 1, "current" => $user->activated) : array("code" => 0, "current" => $user->activated));
    }

    public function change($id) {
        return View::make("CoreCms::user.changepass")->with("user_id", $id);
    }

    public function submitchange($id) {
        $user = AdminUser::findOrFail($id);
        $data = array(
            "password" => Input::get("password"),
            "repassword" => Input::get("repassword"),
        );

        $rules = array(
            "password" => "required|min:6",
            "repassword" => "required|min:6|same:password",
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.users.change')->withErrors($validator)->withInput();
        } else {
            $user->password = $data['password'];
            if ($user->save()) {
                Session::flash('success', "Đã cập nhật password user" . $user->email . " thành công");
                return Redirect::route('admin.users.change', $id);
            } else {
                Session::flash('error', "Xảy ra lỗi trong khi cập nhật password user " . $user->email);
                return Redirect::route('admin.users.change', $id);
            }
        }
    }

}

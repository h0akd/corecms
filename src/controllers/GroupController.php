<?php

namespace H0akd\Corecms\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use H0akd\Corecms\Models\Group;
use H0akd\Corecms\Models\Module;
use H0akd\Corecms\Models\Permistion;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $rows = Group::paginate(10);
        return View::make("CoreCms::group.listing")->with("models", $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $modules = Module::all();
        $permistions = Permistion::all();
        return View::make("CoreCms::group.create")
                        ->with("modules", $modules)
                        ->with("permistions", $permistions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = array(
            "title" => Input::get("title"),
            "name" => Input::get("alias"),
            "permissions" => Input::get("permissions"),
        );

        $rules = array(
            "title" => "max:255",
            "name" => array(
                "required", "max:40", "regex:/^([a-zA-Z]|\.|_|-)+$/", "unique:groups,name",
            )
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.groups.create')->withErrors($validator)->withInput();
        } else {
            $group = new Group();
            $group->title = $data['title'];
            $group->name = $data['name'];
            $group->permissions = json_encode($data['permissions'] == null ? "" : $data['permissions']);
            if ($group->save()) {
                Session::flash('success', "Đã thêm module " . $data['name'] . " thành công");
                return Redirect::route('admin.groups.create');
            } else {
                Session::flash('error', "Xảy ra lỗi trong khi thêm group " . $data['name']);
                return Redirect::route('admin.groups.create');
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
        $modules = Module::all();
        $permistions = Permistion::all();
        $model = Group::find($id);
        return View::make("CoreCms::group.edit")
                        ->with("model", $model)
                        ->with("modules", $modules)
                        ->with("permistions", $permistions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = array(
            "title" => Input::get("title"),
            "name" => Input::get("alias"),
            "permissions" => Input::get("permissions"),
        );

        $rules = array(
            "title" => "max:255",
            "name" => array(
                "required", "max:40", "regex:/^([a-zA-Z]|\.|_|-)+$/", "unique:groups,name," . $id,
            )
        );



        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.groups.edit')->withErrors($validator)->withInput();
        } else {

            try {
                // Find the group using the group id
                $group = Sentry::findGroupById($id);

                $group->title = $data['title'];
                $group->name = $data['name'];
                // Update the group details
                $group->permissions = $data['permissions'] == null ? "" : $data['permissions'];

                // Update the group
                if ($group->save()) {
                    Session::flash('success', "Đã cập nhật module " . $data['name'] . " thành công");
                    return Redirect::route('admin.groups.edit', $id);
                } else {
                    Session::flash('error', "Xảy ra lỗi không thể cập nhật được nhóm " . $data['name']);
                    return Redirect::route('admin.groups.edit', $id);
                }
            } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
                Session::flash('error', "Nhóm đã tồn tại " . $data['name']);
                return Redirect::route('admin.groups.edit', $id);
            } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
                Session::flash('error', "Không tìm thấy nhóm " . $data['name']);
                return Redirect::route('admin.groups.edit', $id);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $model = Group::findOrFail($id);
        return json_encode($model->delete() ? array("code" => 1) : array("code" => 0));
    }

}

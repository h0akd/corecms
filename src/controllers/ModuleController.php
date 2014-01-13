<?php

namespace H0akd\Corecms\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use H0akd\Corecms\Models\Module;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $rows = Module::paginate(10);
        return View::make("CoreCms::module.listing")->with("models", $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make("CoreCms::module.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = array(
            'name' => Input::get("name"),
            'alias' => Input::get("alias"),
            'child' => array_values(Input::get("child")),
        );

        //Loại bỏ phần tử cuối cùng trong trường hợp user không nhập đầy đủ thông tin
        foreach ($data['child'] as $key => $child) {
            if ($child['menu-title'] === "" || $child['tab-title'] === "" || $child['url'] === "") {
                unset($data['child'][$key]);
            }
        }

        $rules = array(
            "name" => "required|max:255",
            "alias" => "required|unique:modules|max:40|alpha",
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.modules.create')->withErrors($validator)->withInput();
        } else {
            $model = new Module();
            $model->name = $data['name'];
            $model->alias = $data['alias'];
            $model->childs = json_encode($data['child']);
            if ($model->save()) {
                Session::flash('success', "Đã thêm module $model->name thành công");
                return Redirect::route('admin.modules.create');
            } else {
                Session::flash('error', "Xảy ra lỗi trong quá trình thêm module $model->name");
                return Redirect::route('admin.modules.create');
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
        $model = Module::findOrFail($id);
        return View::make("CoreCms::module.edit")->with("model", $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $model = Module::findOrFail($id);
        $data = array(
            'name' => Input::get("name"),
            'child' => array_values(Input::get("child")),
        );


        $rules = array(
            "name" => "required|max:255",
        );

        //Loại bỏ phần tử cuối cùng trong trường hợp user không nhập đầy đủ thông tin
        foreach ($data['child'] as $key => $child) {
            if ($child['menu-title'] === "" || $child['tab-title'] === "" || $child['url'] === "") {
                unset($data['child'][$key]);
            }
        }


        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.modules.edit', $id)->withErrors($validator)->withInput();
        } else {
            $model->name = $data['name'];
            $model->childs = json_encode($data['child']);
            if ($model->save()) {
                Session::flash('success', "Đã sửa module $model->name thành công");
                return Redirect::route('admin.modules.edit', $id);
            } else {
                Session::flash('error', "Xảy ra lỗi trong quá trình sửa module $model->name");
                return Redirect::route('admin.modules.edit', $id);
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
        $model = Module::findOrFail($id);
        return json_encode($model->delete() ? array("code" => 1) : array("code" => 0));
    }

}

<?php

namespace H0akd\Corecms\Controllers;

use Illuminate\Routing\Controller;
use H0akd\Corecms\Models\Permistion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PermistionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $rows = Permistion::paginate(13);
        return View::make("CoreCms::permistion.listing")->with("models", $rows);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make("CoreCms::permistion.create");
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
        );

        $rules = array(
            "name" => "required|max:255",
            "alias" => array(
                "required", "max:40", "regex:/^([a-zA-Z]|\.|_|-)+$/", "unique:permistions,alias",
            )
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.permistions.create')->withErrors($validator)->withInput();
        } else {
            $model = new Permistion();
            $model->name = $data['name'];
            $model->alias = $data['alias'];
            if ($model->save()) {
                Session::flash('success', "Đã thêm quyền '$model->name' thành công");
                return Redirect::route('admin.permistions.create');
            } else {
                Session::flash('error', "Xảy ra lỗi trong quá trình thêm quyền '$model->name'");
                return Redirect::route('admin.permistions.create');
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
        $model = Permistion::findOrFail($id);
        return View::make("CoreCms::permistion.edit")->with("model", $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $model = Permistion::findOrFail($id);

        $data = array(
            'name' => Input::get("name"),
            'alias' => Input::get("alias"),
        );

        $rules = array(
            "name" => "required|max:255",
            "alias" => array(
                "required", "max:40", "regex:/^([a-zA-Z]|\.|_|-)+$/", "unique:permistions,alias," . $id,
        ));

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return Redirect::route('admin.permistions.create', $model->id)->withErrors($validator)->withInput();
        } else {
            $model->name = $data['name'];
            $model->alias = $data['alias'];
            if ($model->save()) {
                return Redirect::route('admin.permistions.index');
            } else {
                Session::flash('error', "Xảy ra lỗi trong quá trình cập nhật quyền '$model->name'");
                return Redirect::route('admin.permistions.edit', $model->id);
            }
        }
    }

    /**
     * Remove the specified resource fr om storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $model = Permistion::findOrFail($id);
        return json_encode($model->delete() ? array("code" => 1) : array("code" => 0));
    }

}

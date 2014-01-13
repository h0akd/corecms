<?php
[@namespace];

use Illuminate\Routing\Controller;

class [@classname] extends Controller {

	
	public function index()	{
            $rows = Permistion::paginate(10);
            return View::make("CoreCms::permistion.listing")->with("models", $rows);
	}

	public function create() {
	}

	public function store()	{
	}

	public function edit($id) {
            $model = Permistion::findOrFail($id);
            return View::make("CoreCms::permistion.create")->with("model",$model);
	}

	public function update($id) {
	}

	public function destroy($id) {
          $model = Module::findOrFail($id);
          return json_encode($model->delete() ? array("code" => 1) : array("code" => 0));
	}
        

}
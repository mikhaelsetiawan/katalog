<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_admin;

class controller_admin extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_admin = model_admin::where(array('admin_status'=>'1'))->get();
		return view('backend.admin.index')->with([
				'model_admin' => $model_admin
			]);
	}

	public function editadmin()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_admin = model_admin::find($_POST['admin_id']);
			$model_admin['admin_status'] = 0;
			$model_admin->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_admin = new model_admin();
				$model_admin->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_admin = model_admin::find($_POST['admin_id']);
				$model_admin->fill($_POST);
				$model_admin->save();
			}
		}
		return redirect('/backend/admin')->withErrors($err);
	}

}

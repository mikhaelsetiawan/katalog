<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_ext_province;
use App\Models\model_ext_country;

class controller_province extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_province = model_ext_province::get();
		$model_ext_country = model_ext_country::all()->sortBy('country_name')->pluck('country_name','country_code');
		return view('backend.province.index')->with([
				'model_province' => $model_province,
				'model_country' => $model_ext_country
			]);
	}

	public function editprovince()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_province = model_ext_province::find($_POST['province_code']);
			$model_province->delete();
		}else{
			if ($_POST['_type'] == 1) {
				$model_province = new model_ext_province();
				$model_province->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_province = model_ext_province::find($_POST['province_code_old']);
				unset($_POST['province_code_old']);
				$model_province->fill($_POST);
				$model_province->save();
			}
		}
		return redirect('/backend/province')->withErrors($err);
	}

}

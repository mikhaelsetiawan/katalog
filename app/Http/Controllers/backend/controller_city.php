<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_ext_city;
use App\Models\model_ext_province;

class controller_city extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_city = model_ext_city::get();
		$model_ext_province = model_ext_province::all()->sortBy('province_name')->pluck('province_name','province_code');
		return view('backend.city.index')->with([
				'model_city' => $model_city,
				'model_province' => $model_ext_province
			]);
	}

	public function editcity()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_city = model_ext_city::find($_POST['city_code']);
			$model_city->delete();
		}else{
			if ($_POST['_type'] == 1) {
				$model_city = new model_ext_city();
				$model_city->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_city = model_ext_city::find($_POST['city_code_old']);
				unset($_POST['city_code_old']);
				$model_city->fill($_POST);
				$model_city->save();
			}
		}
		return redirect('/backend/city')->withErrors($err);
	}

}

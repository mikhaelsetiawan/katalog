<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_building;
use App\Models\model_business;
use App\Models\model_ext_city;

use Illuminate\Http\Request;

class controller_building extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_building = model_building::where(array('building_status'=>'1'))->get();
		$model_ext_city = model_ext_city::all()->sortBy('city_name')->pluck('city_name','city_code')->toArray();
		return view('backend.building.index')->with([
				'model_building' => $model_building,
				'model_city' => $model_ext_city
			]);
	}

	public function editbuilding()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_building = model_building::find($_POST['building_id']);
			$model_building['building_status'] = 0;
			$model_building->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_building = new model_building();
				$model_building->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_building = model_building::find($_POST['building_id']);
				$model_building->fill($_POST);
				$model_building->save();
			}
		}
		return redirect('/backend/building')->withErrors($err);
	}

}

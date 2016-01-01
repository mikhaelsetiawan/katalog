<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_business_field;
use App\Models\model_ext_country;
use App\Models\model_ext_province;
use App\Models\model_ext_city;
use Illuminate\Support\Str;
use App\Models\model_member;
use Illuminate\Support\Facades\Mail;
use App\Models\model_business;
use App\Models\model_building;

class controller_business extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function addBusiness()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);
		$model_bfield = model_business_field::all()->sortBy('bfield_name')->pluck('bfield_name','bfield_id')->toArray();

		$model_business_parent = model_business::where('business_status','1')->orderBy('business_name')->pluck('business_name','business_id')->toArray();
		$model_business_parent = ['0'=>'No Parent'] + $model_business_parent;

		$model_ext_country = model_ext_country::all()->sortBy('country_name')->pluck('country_name','country_code')->toArray();
		$model_ext_city = model_ext_city::all()->sortBy('city_name')->pluck('city_name','city_code')->toArray();
		$model_building = model_building::all()->sortBy('building_name')->pluck('building_name','building_id')->toArray();

		return view('frontend.business.view_business_add')->with([
			'model_member' => $model_member,
			'model_bfield' => $model_bfield,
			'model_business_parent' => $model_business_parent,
			'model_country' => $model_ext_country,
			'model_building' => $model_building,
			'model_city' => $model_ext_city
		]);
	}

	public function submitAddBusiness()
	{
		$err = array();
		if($_POST['building_type'] == 1)
		{//online business
			$_POST['building_status'] = 3;
		}elseif($_POST['building_type'] == 3)
		{
			$model_building = new model_building();
			$model_building->fill($_POST);
			$model_building->save();
		}
		$model_business =  new model_business();
		$model_business->fill($_POST);
		$model_business->save();

		return redirect('/business/success')->withErrors($err);
	}

	public function successAddBusiness()
	{
		return view('frontend.business.view_success')->with([

		]);
	}

	public function addNewBfield()
	{
		$model_bfield = new model_business_field();
		$model_bfield->fill($_POST);
		$model_bfield->save();
		echo ($model_bfield->bfield_id);
	}

	public function getProv()
	{
		$country_id = $_POST['country_id'];
		$model_country = model_ext_country::find($country_id);
		echo json_encode($model_country->province);
	}

	public function getCity()
	{
		$province_id = $_POST['province_id'];
		$model_province = model_ext_province::find($province_id);
		echo json_encode($model_province->city);
	}
}

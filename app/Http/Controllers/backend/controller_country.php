<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_ext_country;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_country extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_country = model_ext_country::get();
		return view('backend.country.index')->with([
				'model_country' => $model_country
			]);
	}

	public function editcountry()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_country = model_ext_country::find($_POST['country_code']);
			$model_country->delete();
		}else{
			if ($_POST['_type'] == 1) {
				$model_country = new model_ext_country();
				$model_country->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_country = model_ext_country::find($_POST['country_code_old']);
				unset($_POST['country_code_old']);
				$model_country->fill($_POST);
				$model_country->save();
			}
		}
		return redirect('/backend/country')->withErrors($err);
	}

}

<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_business;

use Illuminate\Http\Request;

class controller_business extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_business = model_business::where(array('business_status'=>'1'))->get();
		$model_business_parent = model_business::where('business_status','1')->orderBy('business_name')->pluck('business_name','business_id')->toArray();
		$model_business_parent = ['0'=>'No Parent'] + $model_business_parent;
		return view('backend.business.index')->with([
				'model_business' => $model_business,
				'model_business_parent' => $model_business_parent,
			]);
	}

	public function editbusiness()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_business = model_business::find($_POST['business_id']);
			$model_business['business_status'] = 0;
			$model_business->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_business = new model_business();
				$model_business->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_business = model_business::find($_POST['business_id']);
				$model_business->fill($_POST);
				$model_business->save();
			}
		}
		return redirect('/backend/business')->withErrors($err);
	}

}

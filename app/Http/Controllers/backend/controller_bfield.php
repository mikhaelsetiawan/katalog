<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_business_field;
use App\Models\model_business;

use Illuminate\Http\Request;

class controller_bfield extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_bfield = model_business_field::where(array('bfield_status'=>'1'))->get();
		$model_bfield_parent = model_business_field::where('bfield_status','1')->orderBy('bfield_name')->pluck('bfield_name','bfield_id')->toArray();
		$model_bfield_parent = ['0'=>'No Parent'] + $model_bfield_parent;
		return view('backend.bfield.index')->with([
				'model_bfield' => $model_bfield,
				'model_bfield_parent' => $model_bfield_parent,
			]);
	}

	public function editbfield()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_bfield = model_business_field::find($_POST['bfield_id']);
			$model_bfield['bfield_status'] = 0;
			$model_bfield->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_bfield = new model_business_field();
				$model_bfield->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_bfield = model_business_field::find($_POST['bfield_id']);
				$model_bfield->fill($_POST);
				$model_bfield->save();
			}
		}
		return redirect('/backend/bfield')->withErrors($err);
	}

}

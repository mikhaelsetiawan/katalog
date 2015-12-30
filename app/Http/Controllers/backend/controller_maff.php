<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_member_affiliation;
use App\Models\model_business;
use App\Models\model_member;

use Illuminate\Http\Request;

class controller_maff extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_member_affiliation = model_member_affiliation::where(array('maff_status'=>'1'))->get();
		$model_business = model_business::where('business_status','1')->orderBy('business_name')->pluck('business_name','business_id')->toArray();
		$model_member = model_member::where('member_status','1')->orderBy('member_name')->pluck('member_name','member_id')->toArray();
		return view('backend.maff.index')->with([
				'model_maff' => $model_member_affiliation,
				'model_business' => $model_business,
				'model_member' => $model_member
			]);
	}

	public function editmaff()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_member_affiliation = model_member_affiliation::find($_POST['maff_id']);
			$model_member_affiliation['maff_status'] = 0;
			$model_member_affiliation->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_member_affiliation = new model_member_affiliation();
				$model_member_affiliation->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_member_affiliation = model_member_affiliation::find($_POST['maff_id']);
				$model_member_affiliation->fill($_POST);
				$model_member_affiliation->save();
			}
		}
		return redirect('/backend/maff')->withErrors($err);
	}

}

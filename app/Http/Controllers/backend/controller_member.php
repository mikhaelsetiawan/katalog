<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_member;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_member extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_member = model_member::where(array('member_status'=>'1'))->get();
		$model_ext_city = model_ext_city::all()->sortBy('city_name')->pluck('city_name','city_code');
		return view('backend.member.index')->with([
				'model_member' => $model_member,
				'model_city' => $model_ext_city
			]);
	}

	public function editMember()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_member = model_member::find($_POST['member_id']);
			$model_member['member_status'] = 0;
			$model_member->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_member = new model_member();
				$model_member->create($_POST);
			}else if ($_POST['_type'] == 2) {
				$model_member = model_member::find($_POST['member_id']);
				$model_member->fill($_POST);
				$model_member->save();
			}
		}
		return redirect('/backend/member')->withErrors($err);
	}

}

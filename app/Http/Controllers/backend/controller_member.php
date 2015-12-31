<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_member;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_member extends Controller {
	//Reminder : buat email baru hati2 unique, kalau sudah hapus tidak bisa buat dengan email yang sama
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

	public function resetPass()
	{
		$err = array();
		$model_member = new model_member();
		$_POST['member_password'] = $model_member->genPass();
		$_POST['sendPass'] = $_POST['member_password'];
		$_POST['member_password'] = bcrypt($_POST['member_password']);

		$model_member = model_member::find($_POST['member_id']);
		$model_member->fill($_POST);
		if($model_member->save())
		{
			$data = $_POST;
			$data['member_email'] = $model_member->member_email;
			$data['member_name'] = $model_member->member_name;
			$model_member->emailResetPass($data);
		}
		return redirect('/backend/member')->withErrors($err);
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
				$_POST['member_password'] = $model_member->genPass();
				$_POST['sendPass'] = $_POST['member_password'];
				$_POST['member_password'] = bcrypt($_POST['member_password']);
				if($model_member->create($_POST))
				{
					$data = $_POST;
					$model_member->emailGenPass($data);
				}
			}else if ($_POST['_type'] == 2) {
				$model_member = model_member::find($_POST['member_id']);
				$model_member->fill($_POST);
				$model_member->save();
			}
		}
		return redirect('/backend/member')->withErrors($err);
	}

}

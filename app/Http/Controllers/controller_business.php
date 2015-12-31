<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Str;
use App\Models\model_member;
use Illuminate\Support\Facades\Mail;

class controller_business extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	/*public function testEmail()
	{
		$model_member = new model_member();

		$data = array();
		$data['name'] = 'Regina Felangi';
		$data['email'] = 'mikhaelsetiawan92@gmail.com';
		$data['password'] = $model_member->generateNewPassword();
		echo $data['password'];
		echo $model_member->sendEmailGenPassNewMember($data);
	}*/
}

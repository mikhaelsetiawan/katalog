<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_frontend extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function register() {
		$param["data"] = 'tes';
		return view('frontend.view_member_register',$param);
	}

	public function login() {
		$param["data"] = 'tes';
		return view('frontend.view_member_login',$param);
	}

	public function submitRegister(Request $request)
	{

	}

	public function authLogin(Request $request)
	{
		$this->validate($request,
			[
				'member_email'	=>	'required',
				'member_password'	=>	'required'
			],
			[
				'member_email.required'		=>	'Silahkan mengisikan email.',
				'member_password.required'		=>	'Silahkan mengisikan password'
			]);

		$auth = auth()->guard('member');

		$credentials = [
			'member_email' =>  $request->get('member_email'),
			'password' =>  $request->get('member_password'),
		];

		if ($auth->attempt($credentials)) {
			return redirect('/');
		}

		return redirect('login')
			->withInput($request->only('member_email', 'remember'))
			->withErrors([
					'name' => 'Username/Password tidak benar, silahkan mencoba kembali.',
				]);
	}

}

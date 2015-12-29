<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_member;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_frontend extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

    public function index() {
      
      return view('frontend.view_home');
    
    }
  
	public function register() {
		$model_ext_city = model_ext_city::all()->pluck('city_name','city_code');
		return view('frontend.view_member_register')->with([
				'model_city' => $model_ext_city
			]);
	}

	public function login() {
		$param["data"] = 'tes';
		return view('frontend.view_member_login',$param);
	}

	public function submitRegister(Request $request)
	{
		$this->validate($request,
			[
				'member_name'	=> 'required',
				'member_username'	=> 'required',
				'city_code'	=> 'required',
				'member_gender'	=> 'required',
				'member_email'	=>	'required|unique:member',
				'member_password'	=>	'required|confirmed'
			],
			[
				'member_name.required'		=>	'Silahkan mengisikan nama.',
				'member_username.required'		=>	'Silahkan mengisikan username.',
				'city_code.required'		=>	'Silahkan mengisikan kota.',
				'member_gender.required'		=>	'Silahkan mengisikan jenis kelamin.',
				'member_email.required'		=>	'Silahkan mengisikan email.',
				'member_email.unique'		=>	'Email telah digunakan.',
				'member_password.required'		=>	'Silahkan mengisikan password',
				'member_password.confirmed'		=>	'Password dan Confirm Password tidak sama'
			]);

		$member = new model_member();
		$request['member_coin'] = 100;
		$request['member_password'] = bcrypt($request['member_password']);
		if($member->create($request->except('member_password_confirmation')))
		{
			return redirect('home');
		}else{
			return redirect('register')
				->withInput($request->only('member_email', 'remember'))
				->withErrors([
						'name' => 'Terdapat isian yang salah, silakan mengisi ulang form.',
					]);
		}
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

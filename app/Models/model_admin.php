<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class model_admin extends Model implements AuthenticatableContract, CanResetPasswordContract{

	use Authenticatable, CanResetPassword;

	protected $table = 'admin';
	protected $primaryKey = 'admin_id';
	protected $fillable = [
		'admin_name',
		'admin_email',
		'admin_username',
		'admin_password',
	];

	public function init() {

	}

	public function fields() {

	}

	public function genPass()
	{
		return Str::lower(Str::quickRandom(12));
	}

	public function emailGenPass($data)
	{
		$email = $data['admin_email'];
		if(!isset($data['sendPass']) || $data['sendPass'] == '') {
			$data['sendPass'] = $this->genPass();
		}
		Mail::send('email.genPassNewAdmin', ['data'=>$data], function($message) use($email)
			{
				$message->from('info@maxel.id', 'Maxel.id Info Center');
				$message->subject('Welcome to Maxel Id Catalog');
				$message->to($email);
			});
		return $data['sendPass'];
	}

	public function emailResetPass($data)
	{
		$email = $data['admin_email'];
		if(!isset($data['sendPass']) || $data['sendPass'] == '') {
			$data['sendPass'] = $this->genPass();
		}
		Mail::send('email.resetPassAdmin', ['data'=>$data], function($message) use($email)
			{
				$message->from('info@maxel.id', 'Maxel.id Info Center');
				$message->subject('Welcome to Maxel Id Catalog');
				$message->to($email);
			});
		return $data['sendPass'];
	}

	public function city()
	{
		return $this->belongsTo('App\Models\model_ext_city','city_code', 'city_code');
	}

	public function getAuthPassword() {
		return $this->admin_password;
	}
}

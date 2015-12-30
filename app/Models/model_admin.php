<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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

	public function city()
	{
		return $this->belongsTo('App\Models\model_ext_city','city_code', 'city_code');
	}

	public function getAuthPassword() {
		return $this->admin_password;
	}
}

<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class model_member extends Model implements AuthenticatableContract, CanResetPasswordContract{

	use Authenticatable, CanResetPassword;

	protected $table = 'member';
	protected $primaryKey = 'member_id';
	protected $fillable = [
		'member_name',
		'member_email',
		'member_username',
		'member_password',
		'member_birth_date',
		'member_gender',
		'member_fb',
		'member_coin',
		'city_code',
	];

	public function init() {

	}

	public function fields() {

	}

	public function getAuthPassword() {
		return $this->member_password;
	}
}

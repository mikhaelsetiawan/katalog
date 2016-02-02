<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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

	public function genPass()
	{
		return Str::lower(Str::quickRandom(12));
	}

	public function ownedBusiness($mode=0,$member_id="")
	{
		if($member_id == "")
		{
			$member_id = $this->member_id;
		}
		$model_maff = model_member_affiliation::find(['member_id'=>$member_id,'maff_status'=>'1']);
		$model_business = [];
		if($mode == 0)
		{
			foreach($model_maff as $maff)
			{
				$model_business[] = $maff->business;
			}
		}elseif($mode == 1)
		{
			$data = [];
			foreach($model_maff as $maff)
			{
				$data[$maff->business->business_id] = $maff->business->business_name;
			}
			$model_business = $data;
		}
		return $model_business;
	}

	public function emailGenPass($data)
	{
		$email = $data['member_email'];
		if(!isset($data['sendPass']) || $data['sendPass'] == '') {
			$data['sendPass'] = $this->genPass();
		}
		Mail::send('email.genPassNewMember', ['data'=>$data], function($message) use($email)
			{
				$message->from('info@maxel.id', 'Maxel.id Info Center');
				$message->subject('Welcome to Maxel Id Catalog');
				$message->to($email);
			});
		return $data['sendPass'];
	}

	public function emailResetPass($data)
	{
		$email = $data['member_email'];
		if(!isset($data['sendPass']) || $data['sendPass'] == '') {
			$data['sendPass'] = $this->genPass();
		}
		Mail::send('email.resetPassMember', ['data'=>$data], function($message) use($email)
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

	public function historyOrderTicket()
	{
		return $this->hasMany('App\Models\model_ticketH','member_id');
	}

	public function feedback()
	{
		return $this->hasMany('App\Models\model_feedback','member_id')->where('feedback_status',1)->orderBy('feedback.created_at',SORT_DESC);
	}

	public function getAuthPassword() {
		return $this->member_password;
	}
}

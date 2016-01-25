<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_event extends Model{
	protected $table = 'event';
	protected $primaryKey = 'event_id';
	protected $fillable = [
		'business_id',
		'member_id',
		'event_title',
		'event_content',
		'event_address',
		'event_lat',
		'event_lng',
		'event_start_date',
		'event_end_date',
	];

	public function init() {

	}

	public function fields() {

	}

	public function photos()
	{
		return $this->hasMany('App\Models\model_photos_event','event_id', 'event_id')->where(array('pevent_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function schedule()
	{
		return $this->hasMany('App\Models\model_eschedule','event_id', 'event_id')->where(array('eschedule_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}
}

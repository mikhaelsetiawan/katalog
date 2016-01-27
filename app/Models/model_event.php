<?php namespace App\Models;

use Faker\Provider\DateTime;
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
		return $this->hasMany('App\Models\model_eschedule','event_id', 'event_id');
	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}

	public function getUpcomingEvent()
	{
		$date = new \DateTime();
		$now = $date->format("Y-m-d H:i:s");
		$ret = array();
		$ret = $this->join('eschedule','eschedule.event_id','=','event.event_id')
								->where('eschedule.eschedule_end_date','>=',$now)
								->select('event.*')
								->groupBy('event.event_id')
								->orderBy('eschedule.eschedule_start_date')
								->get();
		return $ret;
	}
}

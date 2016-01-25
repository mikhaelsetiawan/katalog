<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_eschedule extends Model{
	protected $table = 'eschedule';
	protected $primaryKey = 'eschedule_id';
	protected $fillable = [
		'event_id',
		'eschedule_address',
		'eschedule_lat',
		'eschedule_lng',
		'eschedule_start_date',
		'eschedule_end_date',
	];

	public function init() {

	}

	public function fields() {

	}

	public function registration()
	{
		return $this->hasMany('App\Models\model_eregistration','eschedule_id', 'eschedule_id')->where(array('eregistration_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function event()
	{
		return $this->belongsTo('App\Models\model_event','event_id', 'event_id');
	}
}

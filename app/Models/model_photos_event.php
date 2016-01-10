<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_photos_event extends Model{
	protected $table = 'photos_event';
	protected $primaryKey = 'pevent_id';
	protected $fillable = [
		'event_id',
		'pevent_uploader',
		'pevent_caption',
	];

	public function init() {

	}

	public function fields() {

	}

	public function event()
	{
		return $this->belongsTo('App\Models\model_event','event_id', 'event_id');
	}

	public function uploader()
	{
		return $this->belongsTo('App\Models\model_member','pevent_uploader', 'member_id');
	}
}

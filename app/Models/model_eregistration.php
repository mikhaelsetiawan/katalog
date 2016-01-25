<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_eregistration extends Model{
	protected $table = 'eregistration';
	protected $primaryKey = 'eregistration_id';
	protected $fillable = [
		'member_id',
		'eschedule_id',
	];

	public function init() {

	}

	public function fields() {

	}

	public function schedule()
	{
		return $this->belongsTo('App\Models\model_eschedule','eschedule_id', 'eschedule_id');
	}

	public function member_id()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}
}

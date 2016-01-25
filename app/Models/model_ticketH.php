<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ticketH extends Model{
	protected $table = 'ticketH';
	protected $primaryKey = 'ticketH_id';
	protected $fillable = [
		'member_id',
		'ticketH_total'
	];

	public function init() {

	}

	public function fields() {

	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}

	public function detail()
	{
		return $this->hasMany('App\Models\model_ticketD','ticketH_id');
	}
}

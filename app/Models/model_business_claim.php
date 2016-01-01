<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_business_claim extends Model{
	protected $table = 'business_claim';
	protected $primaryKey = 'bclaim_id';
	protected $fillable = [
		'business_id',
		'member_id',
		'bclaim_role',
		'bclaim_start_date',
		'bclaim_end_date',
	];

	public function init() {

	}

	public function fields() {

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

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_member_affiliation extends Model{
	protected $table = 'member_affiliation';
	protected $primaryKey = 'maff_id';
	protected $fillable = [
		'business_id',
		'member_id',
		'maff_role',
		'maff_start_date',
		'maff_end_date',
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

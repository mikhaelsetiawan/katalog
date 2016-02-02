<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_review extends Model{
	protected $table = 'review';
	protected $primaryKey = 'review_id';
	protected $fillable = [
		member_id,
		business_id,
		review_content
	];

	public function init() {

	}

	public function fields() {

	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function rating()
	{
		return $this->hasMany('App\Models\model_review_rating','review_id');
	}
}

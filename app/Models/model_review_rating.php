<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_review_rating extends Model{
	protected $table = 'review_rating';
	protected $primaryKey = 'rrating_id';
	protected $fillable = [
		'review_id',
		'rating_id',
		'rrating_score'
	];

	public function init() {

	}

	public function fields() {

	}

	public function review()
	{
		return $this->belongsTo('App\Models\model_review','review_id', 'review_id');
	}

	public function rating()
	{
		return $this->belongsTo('App\Models\model_rating','rating_id', 'rating_id');
	}
}

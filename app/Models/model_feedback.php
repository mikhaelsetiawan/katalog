<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_feedback extends Model{
	protected $table = 'feedback';
	protected $primaryKey = 'feedback_id';
	protected $fillable = [
		'member_id',
		'fcat_id',
		'feedback_content'
	];

	public function init() {

	}

	public function fields() {

	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\model_feedback_category','fcat_id', 'fcat_id');
	}
}

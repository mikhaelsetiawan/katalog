<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_feedback_category extends Model{
	protected $table = 'feedback_category';
	protected $primaryKey = 'fcat_id';
	protected $fillable = [
		'fcat_name'
	];

	public function init() {

	}

	public function fields() {

	}
}

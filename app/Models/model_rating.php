<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_rating extends Model{
	protected $table = 'rating';
	protected $primaryKey = 'rating_id';
	protected $fillable = [
		'rating_name'
	];

	public function init() {

	}

	public function fields() {

	}
}

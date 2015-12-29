<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ext_city extends Model{

	protected $table = 'ext_city';
//	protected $primaryKey = 'city_code';
	protected $fillable = [
		'city_code',
		'province_code',
		'city_name',
	];

	public function init() {

	}

	public function fields() {

	}
}

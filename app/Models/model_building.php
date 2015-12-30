<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_building extends Model{
	protected $table = 'building';
	protected $primaryKey = 'building_id';
	protected $fillable = [
		'business_id',
		'city_code',
		'building_name',
		'building_address',
		'building_lat',
		'building_lng',
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function city()
	{
		return $this->belongsTo('App\Models\model_ext_city','city_code', 'city_code');
	}
}

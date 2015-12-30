<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ext_province extends Model{
	public $incrementing = false;
	protected $table = 'ext_province';
	protected $primaryKey = 'province_code';
	protected $fillable = [
		'province_code',
		'country_code',
		'province_name',
	];

	public function city()
	{
		return $this->hasMany('App\Models\model_ext_city','province_code');
	}

	public function country()
	{
		return $this->belongsTo('App\Models\model_ext_country','country_code', 'country_code');
	}

	public function init() {

	}

	public function fields() {

	}
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ext_country extends Model{
	public $incrementing = false;
	protected $table = 'ext_country';
	protected $primaryKey = 'country_code';
	protected $fillable = [
		'country_code',
		'country_name',
	];

	public function province()
	{
		return $this->hasMany('App\Models\model_ext_province','country_code');
	}

	public function init() {

	}

	public function fields() {

	}
}

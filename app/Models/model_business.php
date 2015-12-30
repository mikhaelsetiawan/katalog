<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_business extends Model{
	protected $table = 'business';
	protected $primaryKey = 'business_id';
	protected $fillable = [
		'business_name',
		'business_email',
		'business_parent',
	];

	public function init() {

	}

	public function fields() {

	}

	public function bfield()
	{
		return $this->hasMany('App\Models\model_business_field','province_code');
	}

	public function parentName()
	{
		$model_business = model_business::find($this->business_parent);
		return $model_business['business_name'];
	}
}

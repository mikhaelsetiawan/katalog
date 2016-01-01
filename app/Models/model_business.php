<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_business extends Model{
	protected $table = 'business';
	protected $primaryKey = 'business_id';
	protected $fillable = [
		'building_id',
		'bfield_id',
		'business_name',
		'business_email',
		'business_url',
		'business_parent',
		'business_status',
	];

	public function init() {

	}

	public function fields() {

	}

	public function building()
	{
		return $this->belongsTo('App\Models\model_building','building_id', 'building_id');
	}

	public function bfield()
	{
		return $this->belongsTo('App\Models\model_business_field','bfield_id', 'bfield_id');
	}

	public function parentName()
	{
		$model_business = model_business::find($this->business_parent);
		return $model_business['business_name'];
	}
}

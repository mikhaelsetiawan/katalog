<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_business_field extends Model{

	protected $table = 'business_field';
	protected $primaryKey = 'bfield_id';
	protected $fillable = [
		'business_id',
		'bfield_name',
		'bfield_parent',
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function parentName()
	{
		$model_business_field = model_business_field::find($this->bfield_parent);
		return $model_business_field['bfield_name'];
	}
}

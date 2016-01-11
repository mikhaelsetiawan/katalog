<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_photos_category extends Model{
	protected $table = 'photos_category';
	protected $primaryKey = 'pcat_id';
	protected $fillable = [
		'business_id',
		'pcat_name',
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function photoBusiness()
	{
		return $this->hasMany('App\Models\model_photos_business','pcat_id', 'pcat_id')->where(array('pbusiness_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_photos_business extends Model{
	protected $table = 'photos_business';
	protected $primaryKey = 'pbusiness_id';
	protected $fillable = [
		'business_id',
		'pbusiness_uploader',
		'pcat_id',
		'pbusiness_caption',
		'pbusiness_path',
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}


	public function category()
	{
		return $this->belongsTo('App\Models\model_photos_category','pcat_id', 'pcat_id');
	}

	public function uploader()
	{
		return $this->belongsTo('App\Models\model_member','pbusiness_uploader', 'member_id');
	}
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_business_field extends Model{

	protected $table = 'business_field';
	protected $primaryKey = 'bfield_id';
	protected $fillable = [
		'bfield_name',
		'bfield_parent',
		'bfield_rating'
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->hasMany('App\Models\model_business','bfield_id', 'bfield_id');
	}

	public function parentName()
	{
		$model_business_field = model_business_field::find($this->bfield_parent);
		return $model_business_field['bfield_name'];
	}

	public function rating()
	{
		$split1 = explode(",",$this->bfield_rating);
		$data = array();
		foreach($split1 as $rating_id)
		{
			$data[] = model_rating::find($rating_id);
		}
		return $data;
	}
}

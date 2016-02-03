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
	protected $excludeReviewMemberId = '';

	public function init() {

	}

	public function fields() {

	}

	public function setExcludeReviewMemberId($member_id)
	{
		$this->excludeReviewMemberId = $member_id;
	}

	public function building()
	{
		return $this->belongsTo('App\Models\model_building','building_id', 'building_id');
	}

	public function bfield()
	{
		return $this->belongsTo('App\Models\model_business_field','bfield_id', 'bfield_id');
	}

	public function maff()
	{
		return $this->hasMany('App\Models\model_member_affiliation','business_id', 'business_id');
	}

	public function claim()
	{
		return $this->hasMany('App\Models\model_business_claim','business_id', 'business_id');
	}

	public function news()
	{
		return $this->hasMany('App\Models\model_news','business_id', 'business_id')->where(array('news_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function event()
	{
		return $this->hasMany('App\Models\model_event','business_id', 'business_id')->where(array('event_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function review($excludeMember = "")
	{
		if($this->excludeReviewMemberId != "")
		{
			return $this->hasMany('App\Models\model_review','business_id', 'business_id')->where('review_status',1)->where('member_id','!=',$this->excludeReviewMemberId)->orderBy('review.created_at',SORT_DESC);
		}else{
			return $this->hasMany('App\Models\model_review','business_id', 'business_id')->where('review_status',1)->orderBy('review.created_at',SORT_DESC);
		}

	}

	public function parentName()
	{
		$model_business = model_business::find($this->business_parent);
		return $model_business['business_name'];
	}
}

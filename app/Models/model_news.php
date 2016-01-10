<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_news extends Model{
	protected $table = 'news';
	protected $primaryKey = 'news_id';
	protected $fillable = [
		'business_id',
		'member_id',
		'news_title',
		'news_content',
	];

	public function init() {

	}

	public function fields() {

	}

	public function photos()
	{
		return $this->hasMany('App\Models\model_photos_news','news_id', 'news_id')->where(array('pnews_status'=>'1'))->orderBy('created_at',SORT_DESC);
	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}
}

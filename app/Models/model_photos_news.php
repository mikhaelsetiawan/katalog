<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_photos_news extends Model{
	protected $table = 'photos_news';
	protected $primaryKey = 'pnews_id';
	protected $fillable = [
		'news_id',
		'pnews_uploader',
		'pnews_caption',
	];

	public function init() {

	}

	public function fields() {

	}

	public function news()
	{
		return $this->belongsTo('App\Models\model_news','news_id', 'news_id');
	}

	public function uploader()
	{
		return $this->belongsTo('App\Models\model_member','pnews_uploader', 'member_id');
	}
}

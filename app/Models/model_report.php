<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_report extends Model{
	/*
	 *
	 * Report target type:
	 * 1. User
	 * 2. Business
	 * 3. News
	 * 4. Event
	 * 5. Review
	 * 6. Photo
	 *
	 */
	protected $table = 'report';
	protected $primaryKey = 'report_id';
	protected $fillable = [
		'member_id',
		'reportcat_id',
		'report_target_type',
		'report_target_id',
		'report_content'
	];

	public function init() {

	}

	public function fields() {

	}

	public function member()
	{
		return $this->belongsTo('App\Models\model_member','member_id', 'member_id');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\model_report_category','reportcat_id', 'reportcat_id');
	}
}

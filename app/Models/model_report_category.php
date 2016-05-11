<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_report_category extends Model{
	protected $table = 'report_category';
	protected $primaryKey = 'reportcat_id';
	protected $fillable = [
		'reportcat_name'
	];

	public function init() {

	}

	public function fields() {

	}
}

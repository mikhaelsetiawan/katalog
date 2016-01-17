<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_bticket extends Model{
	protected $table = 'bticket';
	protected $primaryKey = 'bticket_id';
	protected $fillable = [
		'business_id',
		'ticket_id',
		'bticket_amount',
	];

	public function init() {

	}

	public function fields() {

	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}

	public function ticket()
	{
		return $this->belongsTo('App\Models\model_ticket','ticket_id', 'ticket_id');
	}
}

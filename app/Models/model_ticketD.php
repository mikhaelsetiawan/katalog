<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ticketD extends Model{
	protected $table = 'ticketD';
	protected $primaryKey = 'ticketD_id';
	protected $fillable = [
		'ticketH_id',
		'business_id',
		'ticket_id',
		'ticketD_amount',
		'ticketD_price',
		'ticketD_subtotal'
	];

	public function init() {

	}

	public function fields() {

	}

	public function ticket()
	{
		return $this->belongsTo('App\Models\model_ticket','ticket_id', 'ticket_id');
	}

	public function ticketH()
	{
		return $this->belongsTo('App\Models\model_ticketH','ticketH_id', 'ticketH_id');
	}

	public function business()
	{
		return $this->belongsTo('App\Models\model_business','business_id', 'business_id');
	}
}

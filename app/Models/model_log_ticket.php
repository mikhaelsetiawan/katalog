<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_log_ticket extends Model{
	protected $table = 'log_ticket';
	protected $primaryKey = 'log_ticket_id';
	protected $fillable = [
		'ticket_id',
		'logticket_price',
	];

	public function init() {

	}

	public function fields() {

	}

	public function ticket()
	{
		return $this->belongsTo('App\Models\model_ticket','ticket_id', 'ticket_id');
	}
}

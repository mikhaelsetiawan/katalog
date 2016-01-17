<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class model_ticket extends Model{
	protected $table = 'ticket';
	protected $primaryKey = 'ticket_id';
	protected $fillable = [
		'ticket_name',
		'ticket_price',
		'ticket_description',
		'ticket_status',
	];

	public function init() {

	}

	public function fields() {

	}
}

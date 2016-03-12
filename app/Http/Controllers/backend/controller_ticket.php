<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_log_ticket;
use App\Models\model_ticket;

class controller_ticket extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_ticket = model_ticket::where('ticket_status','>','0')->get();
		return view('backend.ticket.index')->with([
				'model_ticket' => $model_ticket,
			]);
	}

	public function editTicket()
	{
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_ticket = model_ticket::find($_POST['ticket_id']);
			$model_ticket['ticket_status'] = 0;
			$model_ticket->save();
		}else{
			if ($_POST['_type'] == 1) {
				$model_ticket = new model_ticket();
				if($model_ticket->create($_POST))
				{
					$model_log_ticket = new model_log_ticket();
					$data = [];
					$data['ticket_id'] = $model_ticket['ticket_id'];
					$data['logticket_price'] = $model_ticket['ticket_price'];
					$model_log_ticket->create($data);
				}
			}else if ($_POST['_type'] == 2) {
				$model_ticket = model_ticket::find($_POST['ticket_id']);
				$model_ticket->fill($_POST);
				if($model_ticket->save())
				{
					$model_log_ticket = new model_log_ticket();
					$data = [];
					$data['ticket_id'] = $model_ticket['ticket_id'];
					$data['logticket_price'] = $model_ticket['ticket_price'];
					$model_log_ticket->create($data);
				}
			}
		}

		return redirect('/backend/ticket')->withErrors($err);
	}

}

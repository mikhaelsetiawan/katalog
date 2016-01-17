<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_bticket;
use App\Models\model_business;
use App\Models\model_member;
use App\Models\model_ticket;

class controller_ticket extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function buy()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);
		$model_select_ticket = model_ticket::all()->where('ticket_status',1)->pluck('ticket_name','ticket_id')->toArray();
		$model_ticket_data = [];
		$model_ticket = model_ticket::where('ticket_status',1)->get();
		foreach($model_ticket as $ticket)
		{
			$data = [];
			$data['ticket_id'] = $ticket->ticket_id;
			$data['ticket_name'] = $ticket->ticket_name;
			$data['ticket_price'] = $ticket->ticket_price;
			$data['ticket_description'] = $ticket->ticket_description;
			$model_ticket_data[$ticket->ticket_id] = $data;
		}
		$model_member = model_member::find($member_id);
		$model_business = $model_member->ownedBusiness(1);

		return view('frontend.ticket.view_buy')->with([
			'model_select_ticket' => $model_select_ticket,
			'model_ticket' => json_encode($model_ticket_data),
			'model_business' => $model_business,
			'model_member' => $model_member,
		]);
	}

	public function submitBuy()
	{
		$err = [];
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);
		$total = 0;
		for($i = 0; $i < count($_POST['ticket_id']); $i++ )
		{
			$model_bticket = model_bticket::where(['ticket_id'=>$_POST['ticket_id'][$i],'business_id'=>$_POST['business_id'][$i]])->first();
			$model_bticket->bticket_amount += $_POST['bticket_amount'][$i];
			$model_bticket->save();

			$model_ticket = model_ticket::find($_POST['ticket_id'][$i]);
			$subtotal = $_POST['bticket_amount'][$i]*$model_ticket->ticket_price;
			$total += $subtotal;
		}
		$model_member->member_coin -= $total;
		$model_member->save();
		return redirect('/ticket/successBuy')->withErrors($err);
	}

	public function successBuy()
	{
		return view('frontend.ticket.view_success_buy')->with([]);
	}
}

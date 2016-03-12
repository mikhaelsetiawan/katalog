<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_member;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_member extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

  public function index() {    
//    return view('member.view_member_index');
  }

	public function historyOrderTicket()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);

		return view('frontend.member.view_history_ticket')->with(
			['member'=>$model_member]
		);
	}
  
}

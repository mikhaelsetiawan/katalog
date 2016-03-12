<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_eregistration;
use App\Models\model_eschedule;
use App\Models\model_event;

class controller_event extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

  public function listEvent() {
		$model_event = new model_event();
		$model_event = $model_event->getUpcomingEvent();
		return view('frontend.event.view_list_event')->with(
			['model_event' => $model_event]
		);
  }

	public function detailEvent($event_id)
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_event = model_event::find($event_id);
		return view('frontend.event.view_detail_event')->with(
			['model_event' => $model_event,'member_id'=>$member_id]
		);
	}

	public function updateRegistration()
	{
		$err = array();
		if(isset($_POST))
		{
			$member_id = auth()->guard('member')->user()->member_id;
			if($_POST['type'] == 1)
			{
				$model_eregistration = model_eregistration::find($_POST['id']);
				$model_eregistration['eregistration_status'] = 0;
				$model_eregistration->save();
			}elseif($_POST['type'] == 2)
			{
				$data = array();
				$data['eschedule_id'] = $_POST['id'];
				$data['member_id'] = $member_id;
				$model_eregistration = new model_eregistration();
				$model_eregistration->create($data);
			}
			return redirect('/event/detail/'.$_POST['event_id'])->withErrors($err);
		}
	}

}

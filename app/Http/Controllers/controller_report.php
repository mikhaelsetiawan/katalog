<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_report;

class controller_report extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}
	
	public function submitReport()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$_POST['member_id'] = $member_id;
		$model_report = new model_report();
		if($model_report->create($_POST))
		{
			return 1;
		}else{
			return 0;
		}
	}

}

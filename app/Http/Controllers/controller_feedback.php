<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_feedback;
use App\Models\model_feedback_category;
use App\Models\model_member;
use DateTime;

class controller_feedback extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

	public function index()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);

		$model_fcat = model_feedback_category::where('fcat_status',1)->pluck('fcat_name','fcat_id')->toArray();

		return view('frontend.feedback.view_index')->with([
			'model_member'=>$model_member,
			'model_fcat'=>$model_fcat,
			'member_id'=>$member_id
		]);
	}

	public function submitFeedback()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$_POST['member_id'] = $member_id;
		$err = array();
		if ($_POST['_type'] == 3) {
			$model_feedback = model_feedback::find($_POST['feedback_id']);
			$model_feedback['feedback_status'] = 0;
			$ret = $model_feedback->save();
			echo $ret;
		}elseif ($_POST['_type'] == 1) {
			$model_feedback = new model_feedback();
			$model_feedback ->fill($_POST);
			if($model_feedback->save())
			{
				$ret = array();
				$ret['feedback_id'] = $model_feedback->feedback_id;
				$ret['created_at'] = date_format(new DateTime($model_feedback->created_at), 'd-M-Y H:i:s');
				echo json_encode($ret);
			}else{
				$ret = 0;
			}
		}
	}
}

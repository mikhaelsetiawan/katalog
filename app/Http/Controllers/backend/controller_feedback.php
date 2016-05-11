<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_feedback;

class controller_feedback extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_feedback = model_feedback::where(array('feedback_status'=>'1'))->orderBy('created_at',SORT_DESC)->get();
		return view('backend.feedback.index')->with([
				'model_feedback' => $model_feedback
			]);
	}

}

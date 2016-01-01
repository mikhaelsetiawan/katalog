<?php namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\model_business_claim;
use App\Models\model_business;
use App\Models\model_member;

use App\Models\model_member_affiliation;
use Illuminate\Http\Request;

class controller_bclaim extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function index()
	{
		$model_business_claim = model_business_claim::where('bclaim_status','>','0')->get();
		$model_business = model_business::where('business_status','1')->orderBy('business_name')->pluck('business_name','business_id')->toArray();
		$model_member = model_member::where('member_status','1')->orderBy('member_name')->pluck('member_name','member_id')->toArray();
		return view('backend.bclaim.index')->with([
				'model_bclaim' => $model_business_claim,
				'model_business' => $model_business,
				'model_member' => $model_member
			]);
	}

	public function editbclaim()
	{
		$err = array();
		$model_business_claim = model_business_claim::find($_POST['bclaim_id']);
		$model_business_claim['bclaim_status'] = $_POST['_type'];
		$model_business_claim->save();
		if($_POST['_type'] == 2)
		{
			$model_maff = new model_member_affiliation();
			$model_maff['business_id'] = $model_business_claim['business_id'];
			$model_maff['member_id'] = $model_business_claim['member_id'];
			$model_maff['maff_role'] = $model_business_claim['bclaim_role'];
			$model_maff['maff_start_date'] = $model_business_claim['bclaim_start_date'];
			$model_maff['maff_end_date'] = $model_business_claim['bclaim_end_date'];
			$model_maff->save();
		}

		return redirect('/backend/bclaim')->withErrors($err);
	}

}

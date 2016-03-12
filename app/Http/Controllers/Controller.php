<?php

namespace App\Http\Controllers;

use App\Models\model_report_category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct() {
		$model_rcat = model_report_category::where(['reportcat_status'=>1])->pluck('reportcat_name','reportcat_id')->toArray();
       	View::share ( 'reportcat', $model_rcat );
    }
}

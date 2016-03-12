<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_member;
use App\Models\model_ext_city;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class controller_backend extends Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->middleware('auth');
	}

  public function index() {    
    return view('backend.view_backend_index');
  
  }
  
}

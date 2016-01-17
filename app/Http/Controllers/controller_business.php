<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\model_business_field;
use App\Models\model_business_claim;
use App\Models\model_ext_country;
use App\Models\model_ext_province;
use App\Models\model_ext_city;
use App\Models\model_member_affiliation;
use App\Models\model_news;
use App\Models\model_event;
use App\Models\model_photos_business;
use App\Models\model_photos_category;
use App\Models\model_photos_news;
use App\Models\model_photos_event;
use App\Models\model_bticket;
use App\Models\model_ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use App\Models\model_member;
use Illuminate\Support\Facades\Mail;
use App\Models\model_business;
use App\Models\model_building;
use DateTime;

class controller_business extends Controller {

	public function __construct()
	{
		//$this->middleware('auth');
	}

	public function listBusiness()
	{
		$model_business = model_business::all()->sortBy('bfield_name');
		return view('frontend.business.view_list')->with([
			'model_business' => $model_business,
		]);
	}

	public function detailBusiness($business_id)
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_business = model_business::find($business_id);
		$model_claim = model_business_claim::where(['business_id'=>$business_id,'member_id'=>$member_id,'bclaim_status'=>'1'])->get();
		$model_maff = model_member_affiliation::where(['business_id'=>$business_id,'member_id'=>$member_id,'maff_status'=>'1'])->get();
		$model_pcat = model_photos_category::where(['business_id'=>$business_id,'pcat_status'=>1])->pluck('pcat_name','pcat_id')->toArray();
		$model_pbusiness = model_photos_business::where(['business_id'=>$business_id,'pbusiness_status'=>1])->get();
		$sisaticket = [];
		$model_bticket = model_bticket::where(['business_id'=>$business_id])->get();
		foreach($model_bticket as $bticket)
		{
			$sisaticket[$bticket->ticket_id] = $bticket->bticket_amount;
		}

		return view('frontend.business.view_detail')->with([
			'member_id' => $member_id,
			'business' => $model_business,
			'alreadyClaim' => count($model_claim),
			'isOwner' => count($model_maff),
			'pcat' => $model_pcat,
			'pbusiness' => $model_pbusiness,
			'sisaticket' => $sisaticket,
		]);
	}

	public function addPcat()
	{
		$model_pcat = new model_photos_category();
		$model_pcat->fill($_POST);
		$model_pcat->save();
		echo ($model_pcat->pcat_id);
	}


	public function addPBusiness()
	{
		/*$data = array();
		$data['category'] = $_POST['pcat_id'];*/
		$member_id = auth()->guard('member')->user()->member_id;
		for($i=1;$i<=$_POST['count_images_pbusiness'];$i++) {
			if(isset($_POST['pbusiness'.$i.'_image']) && $_POST['pbusiness'.$i.'_image'] != ""){
				$img = $_POST['pbusiness'.$i.'_image'];
				$img = str_replace('data:image/jpeg;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);

				/*$med = $_POST['pbusiness'.$i.'_imageMed'];
				$med = str_replace('data:image/jpeg;base64,', '', $med);
				$med = str_replace(' ', '+', $med);
				$dataMed = base64_decode($med);

				$thumb = $_POST['pbusiness'.$i.'_imageThumb'];
				$thumb = str_replace('data:image/jpeg;base64,', '', $thumb);
				$thumb = str_replace(' ', '+', $thumb);
				$dataThumb = base64_decode($thumb);*/

				$model_pbusiness = new model_photos_business();
				$model_pbusiness['pcat_id']=$_POST['pcat_id'];
				$model_pbusiness['business_id']=$_POST['business_id'];
				$model_pbusiness['pbusiness_uploader']=$member_id;
				$model_pbusiness['pbusiness_caption']=$_POST['pbusiness'.$i.'_caption'];

				if ($model_pbusiness->save()) {
					$file = base_path().'/public/img/pbusiness/images/'.$model_pbusiness->pbusiness_id.'.jpg';
					$success = file_put_contents($file, $data);

					//$data['photos'][] = $model_pbusiness->business_id;

					/*$fileMed = Yii::$app->basePath.'/images/products/medium/'.$imageModel->id;
					$successMed = file_put_contents($fileMed, $dataMed);

					$fileThumb = Yii::$app->basePath.'/images/products/thumbnail/'.$imageModel->id;
					$successThumb = file_put_contents($fileThumb, $dataThumb);*/
				}
			}
		}
//		echo json_encode($data);

		return back();

	}

	public function submitClaimBusiness()
	{
		$err=array();
		$member_id = auth()->guard('member')->user()->member_id;
		$_POST['member_id'] = $member_id;

		$model_bclaim = new model_business_claim();
		$model_bclaim->fill($_POST);
		$model_bclaim->save();

		return redirect('/business/successClaim')->withErrors($err);
	}

	public function addBusiness()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		$model_member = model_member::find($member_id);
		$model_bfield = model_business_field::all()->sortBy('bfield_name')->pluck('bfield_name','bfield_id')->toArray();

		$model_business_parent = model_business::where('business_status','1')->orderBy('business_name')->pluck('business_name','business_id')->toArray();
		$model_business_parent = ['0'=>'No Parent'] + $model_business_parent;

		$model_ext_country = model_ext_country::all()->sortBy('country_name')->pluck('country_name','country_code')->toArray();
		$model_ext_city = model_ext_city::all()->sortBy('city_name')->pluck('city_name','city_code')->toArray();
		$model_building = model_building::all()->sortBy('building_name')->pluck('building_name','building_id')->toArray();

		return view('frontend.business.view_business_add')->with([
			'model_member' => $model_member,
			'model_bfield' => $model_bfield,
			'model_business_parent' => $model_business_parent,
			'model_country' => $model_ext_country,
			'model_building' => $model_building,
			'model_city' => $model_ext_city
		]);
	}

	public function submitAddBusiness()
	{
		$err = array();
		if($_POST['building_type'] == 1)
		{//online business
			$_POST['building_status'] = 3;
		}elseif($_POST['building_type'] == 3)
		{
			$model_building = new model_building();
			$model_building->fill($_POST);
			$model_building->save();
		}
		$model_business =  new model_business();
		$model_business->fill($_POST);
		$model_business->save();

		return redirect('/business/success')->withErrors($err);
	}

	public function submitAddNews()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		if($_POST['_type'] == 1)
		{//new

			$model_bticket = model_bticket::where(['ticket_id'=>1,'business_id'=>$_POST['business_id']])->first();
			if($model_bticket->bticket_amount > 0)
			{
				$model_news =  new model_news();
				$model_news ->fill($_POST);
				if($model_news ->save()) {
					$model_bticket->bticket_amount -= 1;
					$model_bticket->save();

					$_POST['photos'] = json_decode($_POST['photos'], TRUE);
					$dataImg = array();
					for ($i = 1; $i <= count($_POST['photos']); $i++) {
						if (isset($_POST['photos']['pnews' . $i . '_image']) && $_POST['photos']['pnews' . $i . '_image'] != "") {
							$img = $_POST['photos']['pnews' . $i . '_image'];
							$dataImg[$i] = $img;
							$img = str_replace('data:image/jpeg;base64,', '', $img);
							$img = str_replace(' ', '+', $img);
							$data = base64_decode($img);

							/*$med = $_POST['pbusiness'.$i.'_imageMed'];
							$med = str_replace('data:image/jpeg;base64,', '', $med);
							$med = str_replace(' ', '+', $med);
							$dataMed = base64_decode($med);

							$thumb = $_POST['pbusiness'.$i.'_imageThumb'];
							$thumb = str_replace('data:image/jpeg;base64,', '', $thumb);
							$thumb = str_replace(' ', '+', $thumb);
							$dataThumb = base64_decode($thumb);*/

							$model_pnews = new model_photos_news();
							$model_pnews['news_id'] = $model_news->news_id;
							$model_pnews['pnews_uploader'] = $member_id;
							$model_pnews['pnews_caption'] = $_POST['photos']['pnews' . $i . '_caption'];

							if ($model_pnews->save()) {
								$file = base_path() . '/public/img/pnews/images/' . $model_pnews->pnews_id . '.jpg';
								$success = file_put_contents($file, $data);

								/*$fileMed = Yii::$app->basePath.'/images/products/medium/'.$imageModel->id;
								$successMed = file_put_contents($fileMed, $dataMed);

								$fileThumb = Yii::$app->basePath.'/images/products/thumbnail/'.$imageModel->id;
								$successThumb = file_put_contents($fileThumb, $dataThumb);*/
							}
						}
					}

					$data = array();
					$data['news_id'] = $model_news->news_id;
					$data['created_at'] = date_format(new DateTime($model_news->created_at), 'd-M-Y H:i:s');
					$data['photos'] = $dataImg;
					echo json_encode($data);
				}else{
					echo 0;
				}
			}else{
				echo 1;
			}
		}elseif($_POST['_type'] == 2)
		{//edit

		}elseif($_POST['_type'] == 3)
		{//delete
			$model_news =  model_news::find($_POST['news_id']);
			$model_news['news_status'] = 0;
			if($model_news->save())
			{
				echo 1;
			}
		}
	}

	public function submitAddEvent()
	{
		$member_id = auth()->guard('member')->user()->member_id;
		if($_POST['_type'] == 1)
		{//new
			$model_bticket = model_bticket::where(['ticket_id'=>2,'business_id'=>$_POST['business_id']])->first();
			if($model_bticket->bticket_amount > 0) {
				$model_event = new model_event();
				$model_event->fill($_POST);
				if ($model_event->save()) {
					$model_bticket->bticket_amount -= 1;
					$model_bticket->save();
					$_POST['photos'] = json_decode($_POST['photos'], TRUE);
					$dataImg = array();
					for ($i = 1; $i <= count($_POST['photos']); $i++) {
						if (isset($_POST['photos']['pevent' . $i . '_image']) && $_POST['photos']['pevent' . $i . '_image'] != "") {
							$img = $_POST['photos']['pevent' . $i . '_image'];
							$dataImg[$i] = $img;
							$img = str_replace('data:image/jpeg;base64,', '', $img);
							$img = str_replace(' ', '+', $img);
							$data = base64_decode($img);

							/*$med = $_POST['pbusiness'.$i.'_imageMed'];
							$med = str_replace('data:image/jpeg;base64,', '', $med);
							$med = str_replace(' ', '+', $med);
							$dataMed = base64_decode($med);

							$thumb = $_POST['pbusiness'.$i.'_imageThumb'];
							$thumb = str_replace('data:image/jpeg;base64,', '', $thumb);
							$thumb = str_replace(' ', '+', $thumb);
							$dataThumb = base64_decode($thumb);*/

							$model_pevent = new model_photos_event();
							$model_pevent['event_id'] = $model_event->event_id;
							$model_pevent['pevent_uploader'] = $member_id;
							$model_pevent['pevent_caption'] = $_POST['photos']['pevent' . $i . '_caption'];

							if ($model_pevent->save()) {
								$file = base_path() . '/public/img/pevent/images/' . $model_pevent->pevent_id . '.jpg';
								$success = file_put_contents($file, $data);

								/*$fileMed = Yii::$app->basePath.'/images/products/medium/'.$imageModel->id;
								$successMed = file_put_contents($fileMed, $dataMed);

								$fileThumb = Yii::$app->basePath.'/images/products/thumbnail/'.$imageModel->id;
								$successThumb = file_put_contents($fileThumb, $dataThumb);*/
							}
						}
					}
					$data = array();
					$data['event_id'] = $model_event->event_id;
					$data['created_at'] = date_format(new DateTime($model_event->created_at), 'd-M-Y H:i:s');
					$data['photos'] = $dataImg;
					echo json_encode($data);
				} else {
					echo 0;
				}
			}else{
				echo 1;
			}
		}elseif($_POST['_type'] == 2)
		{//edit

		}elseif($_POST['_type'] == 3)
		{//delete
			$model_event =  model_event::find($_POST['event_id']);
			$model_event['event_status'] = 0;
			if($model_event->save())
			{
				echo 1;
			}
		}
	}

	public function successAddBusiness()
	{
		return view('frontend.business.view_success')->with([

		]);
	}

	public function successClaimBusiness()
	{
		return view('frontend.business.view_success_claim')->with([

		]);
	}

	public function addNewBfield()
	{
		$model_bfield = new model_business_field();
		$model_bfield->fill($_POST);
		$model_bfield->save();
		echo ($model_bfield->bfield_id);
	}

	public function getProv()
	{
		$country_id = $_POST['country_id'];
		$model_country = model_ext_country::find($country_id);
		echo json_encode($model_country->province);
	}

	public function getCity()
	{
		$province_id = $_POST['province_id'];
		$model_province = model_ext_province::find($province_id);
		echo json_encode($model_province->city);
	}

	public function getPBusiness()
	{
		if($_POST['pcat_id'] == 0)
		{
			$model_pbusiness = model_photos_business::where(['business_id'=>$_POST['business_id'],'pbusiness_status'=>1])->get();
		}else{
			$model_pbusiness = model_photos_business::where(['business_id'=>$_POST['business_id'],'pcat_id'=>$_POST['pcat_id'],'pbusiness_status'=>1])->get();
		}
		echo json_encode($model_pbusiness);
	}
}

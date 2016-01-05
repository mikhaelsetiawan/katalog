@extends('app')

@section('page-script')

	<style type="text/css">
	  #map { height: 300px;width: 300px; }
	</style>

  <script>
    $(document).ready(function()
    {
      $('#bfield_id').change(function()
      {
        if($('#bfield_id').val() == 0)
        {
          $('#div-addBfield').show();
          $('#button-bfield-1').hide();
        }else{
          $('#div-addBfield').hide();
          $('#button-bfield-1').show();
        }
      });

      $('#button-bfield-1').click(function()
      {
        $('#div-bfield').hide();
        $('#div-business').show();
      });

      $("#edit_country").change(function()
      {
        $.post('./getProv',{_token:'{{ csrf_token() }}',country_id:$('#edit_country').val()},function(data)
        {
          $("#edit_province").find('option').remove().end();
          var province = $.parseJSON(data);

          $("#edit_province").append('<option value=""></option>');

          for(var i = 0; i < province.length; i++)
          {
            $("#edit_province").append('<option value="'+province[i]['province_code']+'">'+province[i]['province_name']+'</option>');
          }

          $("#group_province").show();
          $("#group_city").hide();
        });
      });

      $("#edit_province").change(function()
      {
        $.post('./getCity',{_token:'{{ csrf_token() }}',province_id:$('#edit_province').val()},function(data)
        {
          $("#edit_city").find('option').remove().end();
          var city = $.parseJSON(data);

          $("#edit_city").append('<option value=""></option>');

          for(var i = 0; i < city.length; i++)
          {
            $("#edit_city").append('<option value="'+city[i]['city_code']+'">'+city[i]['city_name']+'</option>');
          }

          $("#group_city").show();
        });
      });

      $('.radio_building').click(function()
      {
        if($("input[name='building_type'][value='3']").is(':checked'))
        {
          $('#private_building').show();
          initMap();
        }else{
          $('#private_building').hide();
        }
      });
    });

    function addNewBfield()
    {
      $.post('./addNewBfield',{_token:'{{ csrf_token() }}',bfield_name:$('#new_bfield_name').val(),bfield_parent:$('#new_bfield_parent').val()},function(data)
      {
        $('#bfield_id option[value="0"]').before('<option value="'+data+'">'+$('#new_bfield_name').val()+'</option>');
        $('#bfield_id').val(data);
        $('#bfield_id').trigger('change');
      });
    }

		function submitFormBuilding()
		{
		  if(countMark > 0)
		  {
        var lat =  markersArray[0].getPosition().lat();
        var lng = markersArray[0].getPosition().lng();
        $("#edit_building_lat").val(lat);
        $("#edit_building_lng").val(lng);
      }else{
        $("#edit_building_lat").val("");
        $("#edit_building_lng").val("");
      }
      $("#form-popup-edit").submit();
		}
  </script>


    <script type="text/javascript">
    var map;
    var markersArray = [];
    var countMark = 0;

    function initMap(inlat, inlng) {
      markersArray = [];
      countMark = 0;
      var isFilled = false;
      var lat = -7.257822;
      var lng = 112.746998;

      if(typeof inlat !== 'undefined' && inlat != '')
      {
      isFilled = true;
        lat = inlat;
      }

      if(typeof inlng !== 'undefined' && inlat != '')
      {
      isFilled = true;
        lng = inlng;
      }

      var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(lat,lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById('map'),mapOptions);

      /*google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng);
      });*/

      if(isFilled == true)
      {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat,lng),
          draggable:true,
          animation: google.maps.Animation.DROP,
  //        title:countMark+"",
          title:"Your building location",
          //icon:'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|'+warna.substr(1)
        });

        google.maps.event.addListener(marker, 'dblclick', removeMark);

        markersArray.push(marker);
        markersArray[countMark].setMap(map);
        countMark++;
      }else{
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng);
        });
      }
    }

    function addMarker(location) {
      if(countMark == 0)
      {
        var x=location.lat();
        var y=location.lng();
        marker = new google.maps.Marker({
          position: location,
          map: map,
          draggable:true,
          animation: google.maps.Animation.DROP,
          title:"Your building location",
          //icon:'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|'+warna.substr(1)
        });
        countMark++;
        google.maps.event.addListener(marker, 'dblclick', removeMark);
        markersArray.push(marker);
//        alert(countMark);
      }
    }

    function removeMark() {
      var hapusMark;
      var countUlang=1;
      for(i in markersArray){
        if(markersArray[i].getPosition() == this.getPosition()){
          hapusMark=i;
        }else{
          markersArray[i].setTitle(countUlang+"");
          countUlang++;
        }
      }
      markersArray[hapusMark].setMap(null);
      markersArray.splice(hapusMark,1);
      countMark--;
//      alert(countMark);
    }
    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EnG_QKTlVAVCEkfba_rlej5-rbC0sSI&sensor=false&libraries=geometry,places">
    </script>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Add Business</div>
					<div class="panel-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
            {!! Form::open(array(
                'class'     => 'form-horizontal',
                'id'        => 'form-popup-edit',
                'method'    => 'POST',
                'action'    => 'controller_business@submitAddBusiness'
                )) !!}
						<div id="div-bfield">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                {{--<div class="form-group">
                  <label class="col-md-4 control-label">Name</label>
                  <div class="col-md-6">
                    {!! Form::input('text','member_name',null, [
                                    'id'    => 'name',
                                    'class' => 'form-control',
                                    'placeholder' => 'Name'
                                    ]) !!}
                  </div>
                </div>--}}

                <div class="form-group">
                  <label class="col-md-4 control-label">Please select your category :</label>
                  <div class="col-md-6">
                    {!! Form::select('bfield_id', $model_bfield +['0'=>'Other...'], null, ['class' => 'form-control','id'=>'bfield_id']) !!}
                  </div>
                </div>

                <div id="div-addBfield" style="display: none;">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="bfield_name">Name : </label>
                        <div class="col-sm-6">
                            {!! Form::input('text','bfield_name',null, [
                                            'id'    => 'new_bfield_name',
                                            'class' => 'form-control',
                                            'placeholder' => 'Name'
                                            ]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="bfield_parent">Parent : </label>
                      <div class="col-md-6">
                        {!! Form::select('bfield_parent', ['0'=>'No Parent'] + $model_bfield, null, ['class' => 'form-control', 'id'=>'new_bfield_parent']) !!}
                      </div>
                    </div>


                    <div class="form-group">
                        <div class="btn-group col-sm-6 col-sm-offset-4" onclick="addNewBfield()">
                            <button type="button" class="btn btn-success btn-sm">
                                <span class="glyphicon glyphicon-ok"></span>
                                <span class="hidden-sm" style="margin-left: 6px;">Add Category</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="button" class="btn btn-primary" id="button-bfield-1">Continue</button>
                  </div>
                </div>
            </div>

            <div id="div-business" style="display: none;">

              <center><h4>More about your business</h4></center>

              <div class="form-group">
                <label class="col-md-4 control-label">Name :</label>
                <div class="col-md-6">
                {!! Form::input('text','business_name',null, [
                                'id'    => 'edit_business_name',
                                'class' => 'form-control',
                                'placeholder' => 'Name'
                                ]) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Email :</label>
                <div class="col-md-6">
                {!! Form::input('email','business_email',null, [
                                'id'    => 'edit_business_email',
                                'class' => 'form-control',
                                'placeholder' => 'Email'
                                ]) !!}
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Url :</label>
                <div class="col-md-6">
                {!! Form::input('text','business_url',null, [
                                'id'    => 'edit_business_url',
                                'class' => 'form-control',
                                'placeholder' => 'Url'
                                ]) !!}
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-sm-4" for="city_code">Parent : </label>
                <div class="col-md-6">
                  {!! Form::select('business_parent', $model_business_parent, null, ['class' => 'form-control', 'id'=>'edit_business_parent']) !!}
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-sm-4" for="city_code">Country : </label>
                <div class="col-md-6">
                  {!! Form::select('country_code', [''=>'']+$model_country, null, ['class' => 'form-control', 'id'=>'edit_country']) !!}
                </div>
              </div>

              <div class="form-group" id="group_province" style="display: none">
                  <label class="control-label col-sm-4" for="city_code">Province : </label>
                <div class="col-md-6">
                  <select class='form-control' name="province_code" id="edit_province"></select>
                </div>
              </div>

              <div class="form-group" id="group_city" style="display: none">
                  <label class="control-label col-sm-4" for="city_code">City : </label>
                <div class="col-md-6">
                  <select class='form-control' name="city_code" id="edit_city"></select>
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-sm-4" for="city_code">Where is your business located? : </label>
                <div class="col-md-6">
                  <div class="radio">
                    <label><input type="radio" class="radio_building" value="1" name="building_type">Only avaiable online.</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" class="radio_building" value="2" name="building_type">At public building/shopping center.</label>
                    {!! Form::select('building_id', $model_building, null, ['class' => 'form-control', 'id'=>'edit_building']) !!}
                  </div>
                  <div class="radio">
                    <label><input type="radio" class="radio_building" value="3" name="building_type">At private building.</label>
                  </div>
                </div>
              </div>

              <div id="private_building" style="display: none;">
                <div class="form-group">
                  <label class="col-md-4 control-label">Building Name :</label>
                  <div class="col-md-6">
                  {!! Form::input('text','building_name',null, [
                                  'id'    => 'edit_building_name',
                                  'class' => 'form-control',
                                  'placeholder' => 'Building Name'
                                  ]) !!}
                  </div>
                </div>

                {{--<div class="form-group">
                    <label class="control-label col-sm-4" for="city_code">City : </label>
                  <div class="col-md-6">
                    {!! Form::select('city_code', $model_city, null, ['class' => 'form-control', 'id'=>'edit_city_code']) !!}
                  </div>
                </div>--}}

                <div class="form-group">
                  <label class="col-md-4 control-label">Building Address :</label>
                  <div class="col-md-6">
                  {!! Form::input('text','building_address',null, [
                                  'id'    => 'edit_building_address',
                                  'class' => 'form-control',
                                  'placeholder' => 'Building Address'
                                  ]) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="building_name">Point your location : </label>
                    <div class="col-sm-6">
                      <input type="hidden" name="building_lat" id="edit_building_lat" />
                      <input type="hidden" name="building_lng" id="edit_building_lng" />
                      <div id="map"></div>
                    </div>
                </div>

              </div>

              {{--<div class="form-group">
                <label class="col-md-4 control-label">Your Role :</label>
                <div class="col-md-6">
                {!! Form::input('text','maff_role',null, [
                                'id'    => 'edit_maff_role',
                                'class' => 'form-control',
                                'placeholder' => 'Role'
                                ]) !!}
                </div>
              </div>--}}

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="button" class="btn btn-primary" onclick="submitFormBuilding()">Submit</button>
                </div>
              </div>

            </div>

            {!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

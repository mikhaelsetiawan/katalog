@extends('backend.view_backend_index')

@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-edit">
        <div class="popup-header">
            Form Edit Data
        </div>
        <div class="popup-body">
            {!! Form::open(array(
                'class'     => 'form-horizontal',
                'id'        => 'form-popup-edit',
                'method'    => 'POST',
                'action'    => 'backend\controller_building@editBuilding'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="building_id" id="edit_building_id" value="" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="building_name">Name : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','building_name',null, [
                                        'id'    => 'edit_building_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Name'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city_code">City : </label>
                  <div class="col-md-10">
                    {!! Form::select('city_code', $model_city, null, ['class' => 'form-control', 'id'=>'edit_city_code']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="building_name">Address : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','building_address',null, [
                                        'id'    => 'edit_building_address',
                                        'class' => 'form-control',
                                        'placeholder' => 'Address'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="building_name">Point your location : </label>
                    <div class="col-sm-10">
                      <input type="hidden" name="building_lat" id="edit_building_lat" />
                      <input type="hidden" name="building_lng" id="edit_building_lng" />
                      <div id="map"></div>
                    </div>
                </div>

                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-edit').submit()">
                        <button type="button" class="btn btn-success btn-sm" onclick="submitFormBuilding()">
                            <span class="glyphicon glyphicon-ok"></span>
                            <span class="hidden-sm" style="margin-left: 6px;">Submit</span>
                        </button>
                    </div>
                </div>

            {!! Form::close() !!}
            <div class="cb"></div>
        </div>
    </div>

    <div class="popup-box" id="popup-delete">
        <div class="popup-header"></div>
        <div class="popup-body">
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_building@editBuilding') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="building_id" id="delete_key" value="" />
                <div class="form-group">
                    <div class="col-sm-12">
                        Are you sure wants to delete this item?
                    </div>
                </div>
                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-delete').submit()">
                        <button type="submit" class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-ok"></span>
                            <span class="hidden-sm" style="margin-left: 6px;">OK</span>
                        </button>
                    </div>
                    <div class="btn-group fr" onclick="closePopup()" style="margin-right: 10px;">
                        <button type="button" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-remove"></span>
                            <span class="hidden-sm" style="margin-left: 6px;">Cancel</span>
                        </button>
                    </div>
                </div>
            </form>
            <div class="cb"></div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Building</h3>
        @if($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{{ $err }}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table id="table_building" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th style="width: 115px;">Action</th>
					<th>Name</th>
					<th>City</th>
					<th>Address</th>
					<th>Lat</th>
					<th>Lng</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_building as $building)
					<tr>
            <td>
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $building['building_id'] }}}",
                  "{{{ $building['building_name'] }}}",
                  "{{{ $building['city_code'] }}}",
                  "{{{ $building['building_address'] }}}",
                  "{{{ $building['building_lat'] }}}",
                  "{{{ $building['building_lng'] }}}"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $building['building_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
            </td>
						<td>{!! $building['building_name'] !!}</td>
						<td>{!! $building->city->city_name !!}</td>
						<td>{!! $building['building_address'] !!}</td>
						<td>{!! $building['building_lat'] !!}</td>
						<td>{!! $building['building_lng'] !!}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('page-script')

	<style type="text/css" class="init">
        #dtcustom
        {
            display: inline-block;
        }
        #map { height: 300px;width: 300px; }
	</style>

	<script type="text/javascript">
		//var editor; // use a global for the submit and return data rendering in the examples
        var $model_building = JSON.parse( '{!! (json_encode($model_building)) !!}' );

		$(document).ready(function() {
		    $("#table_building").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );

		function popupEdit(id,name,city_code,address,lat,lng)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_building_id").val(id);
		    $("#edit_building_name").val(name);
		    $("#edit_city_code").val(city_code);
		    $("#edit_building_address").val(address);
		    $("#edit_building_lat").val(lat);
		    $("#edit_building_lng").val(lng);
		    openPopup("popup-edit");
        initMap(lat,lng);
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_building_id").val("");
		    $("#edit_building_name").val("");
		    $("#edit_business_id").val("");
		    $("#edit_city_code").val("");
		    $("#edit_building_address").val("");
		    $("#edit_building_lat").val("");
		    $("#edit_building_lng").val("");
		    openPopup("popup-edit");
        initMap();
		}

		function popupDelete(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_key").val(key);
		    openPopup("popup-delete");
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
      alert(countMark);
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
      alert(countMark);
    }
    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EnG_QKTlVAVCEkfba_rlej5-rbC0sSI&sensor=false&libraries=geometry,places">
    </script>
@endsection
@extends('app')

@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-delete-news">
        <div class="popup-header"></div>
        <div class="popup-body">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="_type" id="delete_news_type" value="2" />
            <input type="hidden" name="business_id" id="delete_news_key" value="" />
            <div class="form-group">
                <div class="col-sm-12">
                    Are you sure wants to delete this news?
                </div>
            </div>
            <div class="popup-buttons" style="margin-top: 30px;">
                <div class="btn-group fr" onclick="deleteNews()">
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
            <div class="cb"></div>
        </div>
    </div>
    
    <div class="popup-box" id="popup-delete-event">
        <div class="popup-header"></div>
        <div class="popup-body">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="_type" id="delete_event_type" value="2" />
            <input type="hidden" name="business_id" id="delete_event_key" value="" />
            <div class="form-group">
                <div class="col-sm-12">
                    Are you sure wants to delete this event?
                </div>
            </div>
            <div class="popup-buttons" style="margin-top: 30px;">
                <div class="btn-group fr" onclick="deleteEvent()">
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
            <div class="cb"></div>
        </div>
    </div>
</div>
@endsection

@section('page-script')

	{!! Html::style('css/frontend/business.css') !!}
	<style type="text/css" class="init">
        #dtcustom
        {
            display: inline-block;
        }
        #map { height: 300px;width: 600px; }
	</style>

  <script>
    $(document).ready(function()
    {
      $('#button_klaim').click(function()
      {
        $('#div_klaim').show();
        $('#button_klaim').hide();
      });

      $('#button_post_news').click(function()
      {
        $.post('{{ action('controller_business@submitAddNews') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:1,
                  member_id:'{{ $member_id }}',
                  business_id:'{{ $business->business_id }}',
                  news_title:$('#edit_news_title').val(),
                  news_content:$('#edit_news_content').val()
                },function(data)
        {
          data = $.parseJSON(data);
          var item = '<div class="item" id="news_'+data.news_id+'">' +
                        '<p class="title">'+$('#edit_news_title').val()+'</p>' +
                        '<p class="content">'+$('#edit_news_content').val()+'</p>' +
                        '<p class="date">' +
                          '<span class="button_edit">Edit</span>' +
                          '<span class="button_delete">Delete</span>' +
                          data.created_at+
                        '</p>' +
                      '</div>';
          $('.div_news').prepend(item);
          $('#edit_news_title').val("");
          $('#edit_news_content').val("");
        });
      });
      
      $('#button_post_event').click(function()
      {
        if(countMark > 0)
        {
          var lat =  markersArray[0].getPosition().lat();
          var lng = markersArray[0].getPosition().lng();
          $("#edit_event_lat").val(lat);
          $("#edit_event_lng").val(lng);
        }else{
          $("#edit_event_lat").val("");
          $("#edit_event_lng").val("");
        }
        $.post('{{ action('controller_business@submitAddEvent') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:1,
                  member_id:'{{ $member_id }}',
                  business_id:'{{ $business->business_id }}',
                  event_title:$('#edit_event_title').val(),
                  event_content:$('#edit_event_content').val(),
                  event_address:$('#edit_event_address').val(),
                  event_lat:$('#edit_event_lat').val(),
                  event_lng:$('#edit_event_lng').val(),
                  event_start_date:$('#edit_event_start_date').val(),
                  event_end_date:$('#edit_event_end_date').val(),
                },function(data)
        {
          data = $.parseJSON(data);
          var latlng = $('#edit_event_lat').val()+','+$('#edit_event_lng').val();
          var mapItem = '';
          if($('#edit_event_lat').val() != '' && $('#edit_event_lng').val() != '')
          {
            mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='+latlng+'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'+latlng+'" />';
          }
          var item = '<div class="item" id="event_'+data.event_id+'">' +
                        '<p class="title">'+$('#edit_event_title').val()+'</p>' +
                        '<p class="content">'+$('#edit_event_content').val()+'</p>' +
                        '<p class="address">Address : '+$('#edit_event_address').val()+'</p>' +
                        '<p class="datetime">Date : '+$('#edit_event_start_date').val()+' until '+$('#edit_event_end_date').val()+'</p>' +
                        '<p class="location">'+mapItem+'</p>' +
                        '<p class="date">' +
                          '<span class="button_edit">Edit</span>' +
                          '<span class="button_delete">Delete</span>' +
                          data.created_at+
                        '</p>' +
                      '</div>';
          $('.div_event').prepend(item);
          $('#edit_event_title').val("");
          $('#edit_event_content').val("");
          $('#edit_event_address').val("");
          $('#edit_event_lat').val("");
          $('#edit_event_lng').val("");
          $('#edit_event_start_date').val("");
          $('#edit_event_end_date').val("");
          clearMap();
          $('#gmap_helper').html("Point your marker on map.");
        });
      });
    });

		function popupDeleteNews(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_news_key").val(key);
		    openPopup("popup-delete-news");
		}

		function deleteNews()
		{
        $.post('{{ action('controller_business@submitAddNews') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:3,
                  news_id: $('#delete_news_key').val()
                },function(data)
        {
          if(data == 1)
          {
            $('#news_'+$('#delete_news_key').val()).remove();
            $('#delete_news_key').val("");
            closePopup();
          }
        });
		}

		function popupDeleteEvent(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_event_key").val(key);
		    openPopup("popup-delete-event");
		}

		function deleteEvent()
		{
        $.post('{{ action('controller_business@submitAddEvent') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:3,
                  event_id: $('#delete_event_key').val()
                },function(data)
        {
          if(data == 1)
          {
            $('#event_'+$('#delete_event_key').val()).remove();
            $('#delete_event_key').val("");
            closePopup();
          }
        });
		}
  </script>


    <script type="text/javascript">
    var map;
    var markersArray = [];
    var countMark = 0;
    var geocoder = '';

    $(window).load(function(){
        initMap();
    });

    function initMap(inlat, inlng) {
      geocoder = new google.maps.Geocoder();
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
        google.maps.event.addListener(marker, 'dragend', dragMark);

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
        google.maps.event.addListener(marker, 'dragend', dragMark);
        markersArray.push(marker);
        var lat =  markersArray[0].getPosition().lat();
        var lng = markersArray[0].getPosition().lng();
        codeCoord(lat,lng);
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
      $('#gmap_helper').html("Point your marker on map.");
      countMark--;
//      alert(countMark);
    }

    function clearMap()
    {
      for (var i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
      }
      markersArray = [];
      countMark = 0;
    }

    function codeCoord(lat,lng)
    {
//      var latLng = new Array(lat,lng);
      var latLng = new google.maps.LatLng(lat,lng);
      //console.log(latLng);
      geocoder.geocode( { 'location':latLng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        $('#gmap_helper').html(results[0].formatted_address);
        console.log('done');
      }
      else{
        $('#gmap_helper').html("Point your marker on map.");
        console.log('fail');
      }
      });
    }

    function codeAddress(alamat)
    {
      var sAddress = '';
      if(typeof alamat == 'undefined')
      {
        sAddress = $("#edit_event_address").val();
      }else{
        sAddress = alamat;
      }
      geocoder.geocode( { 'address': sAddress}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
//        if(tipe=='Point'){
          if(countMark == 0)
          {
            addMarker(results[0].geometry.location);
          }else{
            markersArray[0].setPosition(results[0].geometry.location);
          }
//        }
        //alert('done');
        console.log('done');
      }
      else{
        console.log('fail');
        //jika tidak bisa lakukan sesuatu
        //codeAddress('Jimerto, Surabaya, East Java, Indonesia');
      }
      });
    }

    function dragMark()
    {
      var lat =  markersArray[0].getPosition().lat();
      var lng = markersArray[0].getPosition().lng();
      codeCoord(lat,lng);
    }
    </script>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EnG_QKTlVAVCEkfba_rlej5-rbC0sSI&sensor=false&libraries=geometry,places">
    </script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Business</h3>
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
		<table id="table_business" style="width:100%" class="table">
		  <colgroup>
		    <col style="width: 150px;"/>
		    <col style="width: 10px;"/>
		    <col style=""/>
		  </colgroup>
			<thead>
				{{--<tr>--}}
{{--<!--					<th style="width: 115px;">Action</th>-->--}}
					{{--<th>Name</th>--}}
					{{--<th>Email</th>--}}
					{{--<th>Url</th>--}}
					{{--<th>Building</th>--}}
					{{--<th>Category</th>--}}
					{{--<th>Parent</th>--}}
				{{--</tr>--}}
			</thead>
			<tbody>
				{{--@foreach($model_business as $business)--}}
					<tr>
					  <td>Name</td>
					  <td>:</td>
						<td>{!! $business['business_name'] !!}</td>
          </tr>
          <tr>
					  <td>Email</td>
					  <td>:</td>
						<td>{!! $business['business_email'] !!}</td>
          </tr>
          <tr>
					  <td>Url</td>
					  <td>:</td>
						<td>{!! $business['business_url'] !!}</td>
          </tr>
          <tr>
					  <td>Location</td>
					  <td>:</td>
						<td>{!! $business->building->building_name.', '.$business->building->city->city_name !!}</td>
          </tr>
          <tr>
					  <td>Type</td>
					  <td>:</td>
						<td>{!! $business->bfield['bfield_name'] !!}</td>
          </tr>
          <tr>
					  <td>Parent</td>
					  <td>:</td>
						<td>{!! $business->parentName() !!}</td>
          </tr>
          <tr>
					  <td>Owner</td>
					  <td>:</td>
						<td>
						  <?php $count=0; ?>
						  @if(count($business->maff) > 0)
						    @foreach($business->maff as $maff)
						      {!! $maff->member->member_name !!}
						      @if($count < count($business->maff)-1)
						        {!! ', ' !!}
						      @endif
						      <?php $count++; ?>
						    @endforeach
						  @elseif($alreadyClaim > 0)
                {!! 'In Process' !!}
						  @else
                {!! Form::open(array(
                    'class'     => 'form-horizontal',
                    'id'        => 'form-popup-edit',
                    'method'    => 'POST',
                    'action'    => 'controller_business@submitClaimBusiness'
                    )) !!}
                    <input type="hidden" name="business_id" value="{!! $business['business_id'] !!}"/>
                    <button type="button" id="button_klaim" class="btn btn-primary">Klaim</button>
                    <div id="div_klaim" style="display: none;">
                      <table>
                        <colgroup>
                          <col style="width: 150px;"/>
                          <col style="width: 10px;"/>
                          <col style=""/>
                        </colgroup>
                        <tbody>
                          <tr>
                          	<td>Role</td>
                          	<td>:</td>
                          	<td>
                          	{!! Form::input('text','bclaim_role',null, [
                                            'id'    => 'edit_bclaim_role',
                                            'class' => 'form-control',
                                            'placeholder' => 'Role'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td>Bukti Usaha</td>
                          	<td>:</td>
                          	<td>
                          	<input type="file" class=""/>
                          	</td>
                          </tr>
                          <tr>
                          	<td>Start date</td>
                          	<td>:</td>
                            <td>
                            {!! Form::input('text','bclaim_start_date',null, [
                                            'id'    => 'edit_bclaim_start_date',
                                            'class' => 'form-control',
                                            'placeholder' => 'Start Date'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td>End date</td>
                          	<td>:</td>
                            <td>
                              {!! Form::input('text','bclaim_end_date',null, [
                                            'id'    => 'edit_bclaim_end_date',
                                            'class' => 'form-control',
                                            'placeholder' => 'End Date'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td colspan="3">
                              <button type="submit" id="" class="btn btn-success">Submit</button>
                          	</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                {!! Form::close() !!}
						  @endif
						</td>
          </tr>
				{{--@endforeach--}}
			</tbody>
		</table>
	</div>
    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
      <h3>News</h3>

      @if($isOwner > 0)
        <table id="table_addNews" style="width:100%;" class="">
          <colgroup>
            <col style="width: 150px;"/>
            <col style="width: 10px;"/>
            <col style=""/>
          </colgroup>
          <tr>
            <td>Title</td>
            <td>:</td>
            <td>
              {!! Form::input('text','news_title',null, [
                              'id'    => 'edit_news_title',
                              'class' => 'form-control',
                              'placeholder' => 'Title'
                              ]) !!}
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top;">Content</td>
            <td style="vertical-align: top;">:</td>
            <td>
              {!! Form::textarea('news_content', null, [
                              'id'    => 'edit_news_content',
                              'class' => 'form-control',
                              'placeholder' => 'Content',
                              'style' => 'resize:vertical;',
                              'rows' => 2,
                              'cols' => 40
                                ]) !!}
            </td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>
              <button type="button" id="button_post_news" class="btn btn-success fr">Post</button>
            </td>
          </tr>
        </table>
      @endif
      <div class="div_news">
        @foreach($business->news as $news)
          <div class="item" id="news_{!! $news->news_id !!}">
            <p class="title">{!! $news->news_title !!}</p>
            <p class="content">{!! $news->news_content !!}</p>
            <p class="date">
              {{--<span class="button_edit">Edit</span>--}}
              <span class="button_delete" onclick="popupDeleteNews({!! $news->news_id !!})">Delete</span>
              {!! date_format(new DateTime($news->created_at), 'd-M-Y H:i:s') !!}
            </p>
          </div>
        @endforeach
      </div>
    </div>

    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
      <h3>Event</h3>

      @if($isOwner > 0)
        <table id="table_addEvent" style="width:100%;" class="">
          <colgroup>
            <col style="width: 150px;"/>
            <col style="width: 10px;"/>
            <col style=""/>
          </colgroup>
          <tr>
            <td>Title</td>
            <td>:</td>
            <td>
              {!! Form::input('text','event_title',null, [
                              'id'    => 'edit_event_title',
                              'class' => 'form-control',
                              'placeholder' => 'Title'
                              ]) !!}
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top;">Content</td>
            <td style="vertical-align: top;">:</td>
            <td>
              {!! Form::textarea('event_content', null, [
                              'id'    => 'edit_event_content',
                              'class' => 'form-control',
                              'placeholder' => 'Content',
                              'style' => 'resize:vertical;',
                              'rows' => 2,
                              'cols' => 40
                                ]) !!}
            </td>
          </tr>
          <tr>
            <td>Event date</td>
            <td>:</td>
            <td>
              {!! Form::input('text','event_start_date',null, [
                              'id'    => 'edit_event_start_date',
                              'class' => 'form-control',
                              'placeholder' => 'Start date',
                              'style'=>'width:200px;display:inline;'
                              ]) !!} -
              {!! Form::input('text','event_end_date',null, [
                              'id'    => 'edit_event_end_date',
                              'class' => 'form-control',
                              'placeholder' => 'End date',
                              'style'=>'width:200px;display:inline;'
                              ]) !!}
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>:</td>
            <td>
              {!! Form::input('text','event_address',null, [
                              'id'    => 'edit_event_address',
                              'class' => 'form-control',
                              'placeholder' => 'Address'
                              ]) !!}
                        <button type="button" class="btn btn-success btn-sm" onclick="codeAddress()">Point it at maps.</button>
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top;">Point your location</td>
            <td style="vertical-align: top;">:</td>
            <td>
              <input type="hidden" name="event_lat" id="edit_event_lat" />
              <input type="hidden" name="event_lng" id="edit_event_lng" />
              <span class="control-label" id="gmap_helper">Point your marker on map.</span>
              <div id="map"></div>
            </td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>
              <button type="button" id="button_post_event" class="btn btn-success fr">Post</button>
            </td>
          </tr>
        </table>
      @endif
      <div class="div_event">
        @foreach($business->event as $event)
          <div class="item" id="event_{!! $event->event_id !!}">
            <p class="title">{!! $event->event_title !!}</p>
            <p class="content">{!! $event->event_content !!}</p>
            <p class="address">Address : {!! $event->event_address !!}</p>
            <p class="datetime">Date : {!! date_format(new DateTime($event->event_start_date), 'd-M-Y H:i:s') . ' &nbsp;until&nbsp; '. date_format(new DateTime($event->event_end_date), 'd-M-Y H:i:s') !!}</p>
            <?php
              $latlng = $event->event_lat.','.$event->event_lng;
              $mapItem = '';
              if($event->event_lat != '' && $event->event_lng != '')
              {
                $mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='. $latlng .'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'. $latlng .'"/>';
              }
            ?>
            <p class="location">Location:<br/>
              {!! $mapItem !!}
            </p>
            <p class="date">
              {{--<span class="button_edit">Edit</span>--}}
              <span class="button_delete" onclick="popupDeleteEvent({!! $event->event_id !!})">Delete</span>
              {!! date_format(new DateTime($event->created_at), 'd-M-Y H:i:s') !!}
            </p>
          </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
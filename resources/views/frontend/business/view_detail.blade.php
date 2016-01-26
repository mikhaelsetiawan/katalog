@extends('app')

@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-add-photo">
        <div class="popup-header"></div>
        <div class="popup-body">
            {!! Form::open(array(
                'class'     => 'form-horizontal',
                'id'        => 'form-popup-addphoto',
                'method'    => 'POST',
                'action'    => 'controller_business@addPBusiness'
                )) !!}
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="business_id" id="addphoto_business_id" value="{!! $business->business_id !!}" />
            <input type="hidden" name="count_images_pbusiness" id="count_images_pbusiness" value="1" />

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Category : </label>
                <div class="col-sm-10">
                  {!! Form::select('pcat_id', $pcat + ['0'=>'Add New Category'], null, ['style'=>'width:300px','class' => 'form-control pull-left','id'=>'addphoto_pcat_id']) !!}
                </div>
            </div>

            <div class="form-group div-addPcat">
                <label class="control-label col-sm-2" for="">Category Name : </label>
                <div class="col-sm-8">
                    {!! Form::input('text','pcat_name',null, [
                                    'id'    => 'addphoto_pcat_name',
                                    'class' => 'form-control',
                                    'placeholder' => 'Name'
                                    ]) !!}
                </div>
            </div>

            <div class="form-group div-addPcat">
                <div class="btn-group col-sm-8 col-sm-offset-2" onclick="addNewPcat()">
                    <button type="button" class="btn btn-success btn-sm">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="hidden-sm" style="margin-left: 6px;">Add Category</span>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="">Upload : </label>
                <div class="col-sm-10">
                  <div id="upload_pbusiness_result"></div>
                  <input name="upload[]" type="file" multiple="multiple" onchange="loadImageFile(this,1,'pbusiness')"/>
                </div>
            </div>

            <div class="popup-buttons">
                <div class="btn-group fr" id="submit_addPbusiness" onclick="$('#form-popup-addphoto').submit()">
                    <button type="submit" class="btn btn-success btn-sm">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="hidden-sm" style="margin-left: 6px;">Submit</span>
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="cb"></div>
        </div>
    </div>

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
        .map { height: 300px;width: 600px; }
	</style>

	  {!! Html::script('js/massimgcompress.js'); !!}

  <script>
    var sisaTicketNews = parseInt('{{ $sisaticket[1] }}');
    var sisaTicketEvent = parseInt('{{ $sisaticket[2] }}');
    $(document).ready(function()
    {

      $('.div-addPcat').hide();
      $('#addphoto_pcat_id').change(function()
      {
        if($('#addphoto_pcat_id').val() == 0)
        {
          $('.div-addPcat').show();
          $('#submit_addPbusiness').hide();
        }else{
          $('.div-addPcat').hide();
          $('#submit_addPbusiness').show();
        }
      });

      $('#pcat_id').change(function()
      {
        $.post('{{ action('controller_business@getPBusiness') }}',
                {
                  _token:'{{ csrf_token() }}',
                  business_id:'{{ $business->business_id }}',
                  pcat_id:$("#pcat_id").val()
                },function(data)
                {
                  data = $.parseJSON(data);
                  $("#pbusiness_album").html("");
                  for(var i = 0; i < data.length; i++)
                  {
                    var item = '<div class="item" style="background-image: url(\'{{ URL::to('/').'/img/pbusiness/images/' }}'+ data[i].pbusiness_id +'.jpg\');"></div>';
                    $("#pbusiness_album").append(item);
                  }
                });
      });

      $('#button_klaim').click(function()
      {
        $('#div_klaim').show();
        $('#button_klaim').hide();
      });

      $('#button_post_news').click(function()
      {
        var photos = {};
        var countImages = $("#count_images_pnews").val();
        for(var i = 1;i <= countImages; i++)
        {
          photos['pnews'+i+'_image'] = $('#pnews'+i+'_image').val();
          photos['pnews'+i+'_imageMed'] = $('#pnews'+i+'_imageMed').val();
          photos['pnews'+i+'_imageThumb'] = $('#pnews'+i+'_imageThumb').val();
          photos['pnews'+i+'_caption'] = $('#pnews'+i+'_caption').val();
        }

        $.post('{{ action('controller_business@submitAddNews') }}',
        {
          _token:'{{ csrf_token() }}',
          _type:1,
          member_id:'{{ $member_id }}',
          business_id:'{{ $business->business_id }}',
          news_title:$('#edit_news_title').val(),
          news_content:$('#edit_news_content').val(),
          photos:JSON.stringify(photos)
        },function(data) {
          if(data == 0)
          {
            alert("Post news failed.");
          }else if(data == 1)
          {
            alert("Tiket untuk melakukan post news telah habis.");
          }else{
            data = $.parseJSON(data);

            var photos = '';
            if(Object.keys(data.photos).length > 0)
            {
              photos += '<div class="album">';
              $.each( data.photos, function( index, value ){
                photos += '<div class="item" style="background-image:url(\''+value+'\');"></div>';
              });
              photos += '</div>';
            }
              photos += '<div class="cb"></div>';
            var item = '<div class="item" id="news_'+data.news_id+'">' +
                          '<p class="title">'+$('#edit_news_title').val()+'</p>' +
                          '<p class="content">'+$('#edit_news_content').val()+'</p>' +
                          photos +
                          '<p class="date">' +
                            '<span class="button_edit">Edit</span>' +
                            '<span class="button_delete">Delete</span>' +
                            data.created_at+
                          '</p>' +
                        '</div>';
            $('.div_news').prepend(item);
            $('#edit_news_title').val("");
            $('#edit_news_content').val("");
            $('#upload_pnews_result').html("");
            $("#upload_pnews").replaceWith($("#upload_pnews").clone(true));
            sisaTicketNews--;
            $("#sisaTicket-news").html(sisaTicketNews);
          }
        });
      });
      
      $('#button_post_event').click(function()
      {
        var photos = {};
        var countImages = $("#count_images_pevent").val();
        for(var i = 1;i <= countImages; i++)
        {
          photos['pevent'+i+'_image'] = $('#pevent'+i+'_image').val();
          photos['pevent'+i+'_imageMed'] = $('#pevent'+i+'_imageMed').val();
          photos['pevent'+i+'_imageThumb'] = $('#pevent'+i+'_imageThumb').val();
          photos['pevent'+i+'_caption'] = $('#pevent'+i+'_caption').val();
        }

        var latLng = [];
        var address = [];
        var datetime = [];

        if(countMark[1] > 0)
        {
          var lat =  markersArray[1][0].getPosition().lat();
          var lng = markersArray[1][0].getPosition().lng();
          latLng.push([lat,lng]);
          address.push($("#edit_event_address-"+1).val());
          var startdate = $("#edit_event_start_date-"+1).val();
          var enddate = $("#edit_event_end_date-"+1).val();
          datetime.push(startdate,enddate);
        }

        for(var i = 0; i < saveEschedule.length; i++)
        {
          var index = saveEschedule[i];
          if(countMark[index] > 0)
          {
            var lat =  markersArray[index][0].getPosition().lat();
            var lng = markersArray[index][0].getPosition().lng();
            latLng.push([lat,lng]);
            address.push($("#edit_event_address-"+index).val());
            var startdate = $("#edit_event_start_date-"+index).val();
            var enddate = $("#edit_event_end_date-"+index).val();
            datetime.push([startdate,enddate]);
          }
        }
        /*if(countMark[index] > 0)
        {
          var lat =  markersArray[index][0].getPosition().lat();
          var lng = markersArray[index][0].getPosition().lng();
          $("#edit_event_lat").val(lat);
          $("#edit_event_lng").val(lng);
        }else{
          $("#edit_event_lat").val("");
          $("#edit_event_lng").val("");
        }
*/
        var callbackSubmitEvent = function(data) {

          if(data == 0)
          {
            alert("Post news failed.");
          }else if(data == 1)
          {
            alert("Tiket untuk melakukan post event telah habis.");
          }else{
            data = $.parseJSON(data);

            var photos = '';
            if(Object.keys(data.photos).length > 0)
            {
              photos += '<div class="album">';
              $.each( data.photos, function( index, value ){
                photos += '<div class="item" style="background-image:url(\''+value+'\');"></div>';
              });
              photos += '</div>';
            }
            photos += '<div class="cb"></div>';

            var item = '<div class="item" id="event_'+data.event_id+'">' +
                          '<p class="title">'+$('#edit_event_title').val()+'</p>' +
                          '<p class="content">'+$('#edit_event_content').val()+'</p>' +
                            photos;

            var lat =  markersArray[1][0].getPosition().lat();
            var lng = markersArray[1][0].getPosition().lng();
            var latlng = lat+','+lng;

            var mapItem = '';
            if(lat != '' && lng != '')
            {
              mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='+latlng+'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'+latlng+'" />';
            }
            item +=   '<div class="schedule">' +
                        '<table>' +
                          '<colgroup>' +
                            '<col style="width: 150px;"/>' +
                            '<col style=""/>' +
                            '<col style=""/>' +
                          '</colgroup>' +
                          '<tbody>' +
                            '<tr>' +
                              '<td>Address</td>' +
                              '<td>:</td>' +
                              '<td>'+ $("#edit_event_address-"+1).val() +'</td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td>Date & Time</td>' +
                              '<td>:</td>' +
                              '<td>'+$("#edit_event_start_date-"+1).val()+' - '+$("#edit_event_end_date-"+1).val()+'</td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td style="vertical-align: top;">Location</td>' +
                              '<td style="vertical-align: top;">:</td>' +
                              '<td>' +
                              mapItem +
                              '</td>' +
                            '</tr>' +
                          '</tbody>' +
                        '</table>' +
                     '</div>';

            for(var i = 0; i < saveEschedule.length; i++)
            {
              index = saveEschedule[i];

              lat =  markersArray[index][0].getPosition().lat();
              lng = markersArray[index][0].getPosition().lng();
              latlng = lat+','+lng;

              mapItem = '';
              if(lat != '' && lng != '')
              {
                mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='+latlng+'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'+latlng+'" />';
              }
              item +=   '<div class="schedule">' +
                          '<table>' +
                            '<colgroup>' +
                              '<col style="width: 150px;"/>' +
                              '<col style=""/>' +
                              '<col style=""/>' +
                            '</colgroup>' +
                            '<tbody>' +
                              '<tr>' +
                                '<td>Address</td>' +
                                '<td>:</td>' +
                                '<td>'+ $("#edit_event_address-"+index).val() +'</td>' +
                              '</tr>' +
                              '<tr>' +
                                '<td>Date & Time</td>' +
                                '<td>:</td>' +
                                '<td>'+$("#edit_event_start_date-"+index).val()+' - '+$("#edit_event_end_date-"+index).val()+'</td>' +
                              '</tr>' +
                              '<tr>' +
                                '<td style="vertical-align: top;">Location</td>' +
                                '<td style="vertical-align: top;">:</td>' +
                                '<td>' +
                                mapItem +
                                '</td>' +
                              '</tr>' +
                            '</tbody>' +
                          '</table>' +
                       '</div>';
            }
            item += '<p class="date">' +
                        '<span class="button_edit">Edit</span>' +
                        '<span class="button_delete">Delete</span>' +
                        data.created_at+
                      '</p>' +
                    '</div>';
            $('.div_event').prepend(item);
            $('#edit_event_title').val("");
            $('#edit_event_content').val("");

            $('#edit_event_address-1').val("");
            $('#edit_event_lat-1').val("");
            $('#edit_event_lng-1').val("");
            $('#edit_event_start_date-1').val("");
            $('#edit_event_end_date-1').val("");

            $('.new-eschedule').remove();
            $('#map-1').empty();

            indexEschedule = 1;
            saveEschedule = [];
            countMap = 1;
            map = [];
            markersArray = [];
            countMark = [];
            geocoder = [];

            initMap(1);

            $('#upload_pevent_result').html("");
            $("#upload_pevent").replaceWith($("#upload_pevent").clone(true));
//            clearMap();
            $('#gmap_helper-1').html("Point your marker on map.");
            sisaTicketEvent--;
            $("#sisaTicket-event").html(sisaTicketEvent);
          }
        };

        $.post('{{ action('controller_business@submitAddEvent') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:1,
                  member_id:'{{ $member_id }}',
                  business_id:'{{ $business->business_id }}',
                  event_title:$('#edit_event_title').val(),
                  event_content:$('#edit_event_content').val(),
                  latLng:latLng,
                  address:address,
                  datetime:datetime,
                  photos:JSON.stringify(photos)
                },function(data)
        {
          callbackSubmitEvent(data);
        });
      });
    });

    function addNewPcat()
    {
      $.post('{{ action('controller_business@addPcat') }}',{_token:'{{ csrf_token() }}',pcat_name:$('#addphoto_pcat_name').val(),'business_id':$('#addphoto_business_id').val()},function(data)
      {
//      alert(data);
        $('#addphoto_pcat_id option[value="0"]').before('<option value="'+data+'">'+$('#addphoto_pcat_name').val()+'</option>');
        $('#addphoto_pcat_id').val(data);
        $('#addphoto_pcat_id').trigger('change');
      });
    }

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

		function popupAddPhoto()
		{
		    $('.popup-header').html('Add New Photo');
		    openPopup("popup-add-photo");
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
    var indexEschedule = 1;
    var saveEschedule = [];
    var countMap = 1;
    var map = [];
    var markersArray = [];
    var countMark = [];
    var geocoder = [];

    $(window).load(function(){
        initMap(1);
    });

    function initMap(index,inlat, inlng) {
    console.log(countMark[index]);
      if(index > 1)
      {
        saveEschedule.push(index);
      }
      geocoder[index] = new google.maps.Geocoder();
      countMark[index] = 0;
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
       map[index]= new google.maps.Map(document.getElementById('map-'+index),mapOptions);

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

        google.maps.event.addListener(marker, 'dblclick', function(event){
          removeMark(index,this.getPosition());
        });
        google.maps.event.addListener(marker, 'dragend', function(event){
          dragMark(index)
        });

        markersArray[index].push(marker);
        markersArray[index][countMark[index]].setMap(map[index]);
        countMark[index]++;
      }else{
        google.maps.event.addListener(map[index], 'click', function(event) {
          addMarker(index,event.latLng);
        });
      }
    }

    function addMarker(index,location) {
    console.log(countMark[index]);
      if(countMark[index] == 0)
      {
        var x=location.lat();
        var y=location.lng();
        marker = new google.maps.Marker({
          position: location,
          map: map[index],
          draggable:true,
          animation: google.maps.Animation.DROP,
          title:"Your building location"
          //icon:'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|'+warna.substr(1)
        });
        countMark[index]++;
        google.maps.event.addListener(marker, 'dblclick', function(event){
          removeMark(index,this.getPosition())
        });
        google.maps.event.addListener(marker, 'dragend', function(event){
          dragMark(index)
        });
        markersArray[index] = [];
        markersArray[index].push(marker);
        var lat =  markersArray[index][0].getPosition().lat();
        var lng = markersArray[index][0].getPosition().lng();
        codeCoord(index,lat,lng);
//        alert(countMark);
      }
    }

    function removeMark(index,position) {
      var hapusMark;
      var countUlang=1;
      for(i in markersArray[index]){
        if(markersArray[index][i].getPosition() == position){
          hapusMark=i;
        }else{
          markersArray[index][i].setTitle(countUlang+"");
          countUlang++;
        }
      }
      markersArray[index][hapusMark].setMap(null);
      markersArray[index].splice(hapusMark,1);
      $('#gmap_helper-'+index).html("Point your marker on map.");
      countMark[index]--;
//      alert(countMark);
    }

    function clearMap(index)
    {
      for (var i = 0; i < markersArray[index].length; i++) {
        markersArray[index][i].setMap(null);
      }
      markersArray[index] = [];
      countMark[index] = 0;
    }

    function codeCoord(index,lat,lng)
    {
//      var latLng = new Array(lat,lng);
      var latLng = new google.maps.LatLng(lat,lng);
      //console.log(latLng);
      geocoder[index].geocode( { 'location':latLng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        $('#gmap_helper-'+index).html(results[0].formatted_address);
        console.log('done');
      }
      else{
        $('#gmap_helper-'+index).html("Point your marker on map.");
        console.log('fail');
      }
      });
    }

    function codeAddress(index,alamat)
    {
      var sAddress = '';
      if(typeof alamat == 'undefined')
      {
        sAddress = $("#edit_event_address-"+index).val();
      }else{
        sAddress = alamat;
      }
      geocoder[index].geocode( { 'address': sAddress}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map[index].setCenter(results[0].geometry.location);
        //alert(countMark[index]);
//        if(tipe=='Point'){
          if(countMark[index] == 0)
          {
            addMarker(index,results[0].geometry.location);
          }else{
            markersArray[index][0].setPosition(results[0].geometry.location);
          }
//        }
        //alert('done');
        codeCoord(index,results[0].geometry.location.lat(),results[0].geometry.location.lng());
        console.log('done');
      }
      else{
        console.log('fail');
        //jika tidak bisa lakukan sesuatu
        //codeAddress('Jimerto, Surabaya, East Java, Indonesia');
      }
      });
    }

    function dragMark(index)
    {
      var lat =  markersArray[index][0].getPosition().lat();
      var lng = markersArray[index][0].getPosition().lng();
      codeCoord(index,lat,lng);
    }
    </script>

    <script type="text/javascript">
      function addMoreEschedule()
      {
        indexEschedule++;
        var item = '<tr class="new-eschedule" id="new-eschedule-"'+indexEschedule+'>' +
          '<td colspan="3">' +
          '<hr/>' +
            '<table>' +
              '<colgroup>' +
                '<col style="width: 150px;"/>' +
                '<col style="width: 10px;"/>' +
                '<col style=""/>' +
              '</colgroup>' +
              '<tbody>' +
                '<tr>' +
                  '<td>Event date</td>' +
                  '<td>:</td>' +
                  '<td>' +
                    '<input type="text" name="event_start_date" id="edit_event_start_date-'+ indexEschedule +'" class="form-control" placeholder="Start date" style="width:200px;display:inline;"/> - <input type="text" name="event_end_date" id="edit_event_end_date-'+ indexEschedule +'" class="form-control" placeholder="End date" style="width:200px;display:inline;"/>' +
                  '</td>' +
                '</tr>' +
                '<tr>' +
                  '<td style="vertical-align: top;">Address</td>' +
                  '<td style="vertical-align: top;">:</td>' +
                  '<td>' +
                    '<input type="text" name="event_address" id="edit_event_address-'+ indexEschedule +'" class="form-control" placeholder="Address" />'+
                    '<button type="button" class="btn btn-success btn-sm" onclick="codeAddress(1)">Point it at maps.</button>' +
                  '</td>' +
                '</tr>' +
                '<tr>' +
                  '<td style="vertical-align: top;">Point your location</td>' +
                  '<td style="vertical-align: top;">:</td>' +
                  '<td>' +
                    '<input type="hidden" name="event_lat" id="edit_event_lat-'+indexEschedule+'" />' +
                    '<input type="hidden" name="event_lng" id="edit_event_lng-'+indexEschedule+'" />' +
                    '<span class="control-label" id="gmap_helper-'+indexEschedule+'">Point your marker on map.</span>' +
                    '<div id="map-'+indexEschedule+'" class="map"></div>' +
                  '</td>' +
                '</tr>' +
              '</tbody>' +
            '</table>' +
          '</td>' +
        '</tr>';
        $('#tr-post-event').before(item);
        initMap(indexEschedule);
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
</div>
<div class="row">
  <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
    <h3>Photos</h3>
    <table id="table_photos" style="width:100%;" class="">
      <colgroup>
        <col style="width: 150px;"/>
        <col style="width: 10px;"/>
        <col style=""/>
      </colgroup>
      <tr>
        <td style="vertical-align: top;padding-top:7px;">Category</td>
        <td style="vertical-align: top;padding-top:7px;">:</td>
        <td>
        {!! Form::select('pcat_id', ['0'=>'All'] + $pcat, null, ['style'=>'width:300px','class' => 'form-control pull-left','id'=>'pcat_id']) !!}

        @if($isOwner > 0)
        <button type="button" style="margin-top:2px;margin-left:5px;" onclick="popupAddPhoto()" class="btn btn-success btn-sm pull-left" >
            <span class="glyphicon glyphicon-plus"></span>
            <span class="hidden-sm" style="margin-left: 6px;">Add New Photo</span>
        </button>
        @endif
        </td>
      </tr>
    </table>
    <div class="album" id="pbusiness_album">
      @foreach($pbusiness as $pb)
        <div class="item" style="background-image: url('<?= asset('/img/pbusiness/images/'.$pb->pbusiness_id.'.jpg') ?>');"></div>
      @endforeach
      <div class="cb"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
    <h3>News (sisa tiket : <span id="sisaTicket-news">{{ $sisaticket[1] }}</span>)</h3>

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
          <td style="vertical-align: top;">Upload</td>
          <td style="vertical-align: top;">:</td>
          <td>
            <input type="hidden" name="count_images_pnews" id="count_images_pnews" value="1" />
            <div id="upload_pnews_result"></div>
            <input id="upload_pnews" name="upload[]" type="file" onchange="loadImageFile(this,1,'pnews')"/>
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
          @if(count($news->photos))
            <div class="album">
              @foreach($news->photos as $photo)
                <div class="item" style="background-image: url('{{ URL::to('/').'/img/pnews/images/'.$photo->pnews_id.'.jpg' }}');"></div>
              @endforeach
              <div class="cb"></div>
            </div>
          @endif
          <p class="date">
            {{--<span class="button_edit">Edit</span>--}}
            <span class="button_delete" onclick="popupDeleteNews({!! $news->news_id !!})">Delete</span>
            {!! date_format(new DateTime($news->created_at), 'd-M-Y H:i:s') !!}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
    <h3>Event (sisa tiket : <span id="sisaTicket-event">{{ $sisaticket[2] }}</span>)</h3>

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
          <td style="vertical-align: top;">Upload</td>
          <td style="vertical-align: top;">:</td>
          <td>
            <input type="hidden" name="count_images_pevent" id="count_images_pevent" value="1" />
            <div id="upload_pevent_result"></div>
            <input id="upload_pevent" name="upload[]" type="file" onchange="loadImageFile(this,1,'pevent')"/>
          </td>
        </tr>
        <tr>
          <td colspan="3">
          <hr/>
            <table>
              <colgroup>
                <col style="width: 150px;"/>
                <col style="width: 10px;"/>
                <col style=""/>
              </colgroup>
              <tbody>
                <tr>
                  <td>Event date</td>
                  <td>:</td>
                  <td>
                    {!! Form::input('text','event_start_date',null, [
                                    'id'    => 'edit_event_start_date-1',
                                    'class' => 'form-control',
                                    'placeholder' => 'Start date',
                                    'style'=>'width:200px;display:inline;'
                                    ]) !!} -
                    {!! Form::input('text','event_end_date',null, [
                                    'id'    => 'edit_event_end_date-1',
                                    'class' => 'form-control',
                                    'placeholder' => 'End date',
                                    'style'=>'width:200px;display:inline;'
                                    ]) !!}
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Address</td>
                  <td style="vertical-align: top;">:</td>
                  <td>
                    {!! Form::input('text','event_address',null, [
                                    'id'    => 'edit_event_address-1',
                                    'class' => 'form-control',
                                    'placeholder' => 'Address'
                                    ]) !!}
                              <button type="button" class="btn btn-success btn-sm" onclick="codeAddress(1)">Point it at maps.</button>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Point your location</td>
                  <td style="vertical-align: top;">:</td>
                  <td>
                    <input type="hidden" name="event_lat" id="edit_event_lat-1" />
                    <input type="hidden" name="event_lng" id="edit_event_lng-1" />
                    <span class="control-label" id="gmap_helper-1">Point your marker on map.</span>
                    <div id="map-1" class="map"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr id="tr-post-event">
          <td colspan="2"></td>
          <td>
            <button type="button" id="button_post_event" style="margin-left:5px;" class="btn btn-success btn-sm pull-right">Post</button>
            <button class="btn btn-primary btn-sm pull-right" type="button" onclick="addMoreEschedule()">
              <span class="glyphicon glyphicon-plus"></span>
              <span class="hidden-sm" style="margin-left: 6px;">Add More Schedule</span>
            </button>
          </td>
        </tr>
      </table>
    @endif
    <div class="div_event">
      @foreach($business->event as $event)
        <div class="item" id="event_{!! $event->event_id !!}">
          <p class="title">{!! $event->event_title !!}</p>
          <p class="content">{!! $event->event_content !!}</p>
          @if(count($event->photos))
            <div class="album">
              @foreach($event->photos as $photo)
                <div class="item" style="background-image: url('{{ URL::to('/').'/img/pevent/images/'.$photo->pevent_id.'.jpg' }}');"></div>
              @endforeach
              <div class="cb"></div>
            </div>
          @endif
          @foreach($event->schedule as $schedule)
            <div class="schedule">
              <table>
                <colgroup>
                  <col style="width: 150px;"/>
                  <col style=""/>
                  <col style=""/>
                </colgroup>
                <tbody>
                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td>{!! $schedule->eschedule_address !!}</td>
                  </tr>
                  <tr>
                    <td>Date & Time</td>
                    <td>:</td>
                    <td>{!! date_format(new DateTime($schedule->eschedule_start_date), 'd-M-Y H:i:s') . ' &nbsp;until&nbsp; '. date_format(new DateTime($schedule->eschedule_end_date), 'd-M-Y H:i:s') !!}</td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;">Location</td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                      <?php
                        $latlng = $schedule->eschedule_lat.','.$schedule->eschedule_lng;
                        $mapItem = '';
                        if($schedule->eschedule_lat != '' && $schedule->eschedule_lng != '')
                        {
                          $mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='. $latlng .'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'. $latlng .'"/>';
                        }
                      ?>
                      {!! $mapItem !!}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          @endforeach
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
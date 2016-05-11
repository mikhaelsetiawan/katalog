@extends('frontend/view_frontend_index')

@section('popup')
@endsection

@section('page-script')
	{!! Html::style('css/frontend/event.css') !!}
  <style type="text/css" class="init">
  </style>

  <script>
    function registration(id,type,value)
    {
      $("#registration-id").val(id);
      $("#registration-type").val(type);
      $("#registration-value").val(value);
      $("#form-registration").submit();
    }
  </script>
@endsection

@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h3>{{$model_event->event_title}}</h3>
    <h5>{{$model_event->event_content}}</h5>
    <p>By : {{$model_event->business->business_name}}</p>
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
	  <h3>Schedule</h3>
    {!! Form::open(array(
        'class'     => 'form-horizontal',
        'id'        => 'form-registration',
        'method'    => 'POST',
        'action'    => 'controller_event@updateRegistration'
        )) !!}
	    <input id="registration-type" name="type" type="hidden"/>
	    <input id="registration-id" name="id" type="hidden"/>
	    <input id="registration-value" name="value" type="hidden"/>
	    <input name="event_id" value="{{ $model_event->event_id }}" type="hidden"/>
      <table class="table">
        <thead>
          <th>Address</th>
          <th>Datetime</th>
          <th>Maps</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach($model_event->schedule as $schedule)
          <tr>
            <td>{{ $schedule->eschedule_address  }}</td>
            <td>{{ date_format(new DateTime($schedule->eschedule_start_date), 'd-M-Y H:i:s').'-'.date_format(new DateTime($schedule->eschedule_start_date), 'd-M-Y H:i:s')  }}</td>
            <td>
              <?php
                $latlng = $schedule->eschedule_lat.','.$schedule->eschedule_lng;
                $mapItem = '';
                if($schedule->eschedule_lat != '' && $schedule->eschedule_lng != '')
                {
                  $mapItem = '<img class="map_img" src="http://maps.googleapis.com/maps/api/staticmap?center='. $latlng .'&zoom=15&size=400x200&maptype=roadmap&markers=color:red|'. $latlng .'"/>';
                }
              ?>
              {!! $mapItem !!}
            </td>
            <td>
            <?php
              $registration = $schedule->registration->where('member_id',$member_id)->first();
              if(count($registration) > 0){
            ?>
                <div class="btn-group" onclick="registration( {{ $registration['eregistration_id'] }},1,0)" >
                    <button type="button" class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>
                        <span class="hidden-sm" style="margin-left: 6px;">Cancel registration</span>
                    </button>
                </div>
              <?php }else{ ?>
                <div class="btn-group" onclick="registration( {{ $schedule->eschedule_id }} ,2,1)">
                    <button type="button" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-ok"></span>
                        <span class="hidden-sm" style="margin-left: 6px;">Register</span>
                    </button>
                </div>
              <?php } ?>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    {!! Form::close() !!}
  </div>
</div>
@endsection
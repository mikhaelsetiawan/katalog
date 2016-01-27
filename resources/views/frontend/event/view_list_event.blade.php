@extends('backend')

@section('popup')
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Event Schedule</h3>
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
		<table id="table_event" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
<!--					<th style="width: 115px;">Action</th>-->
					<th>Title</th>
					<th>Description</th>
					<th>Business</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_event as $event)
					<tr>
						<td><a href="{{ url('/event/detail/'.$event->event_id) }}">{!! $event->event_title !!}</a></td>
						<td>{!! $event->event_content !!}</td>
						<td>{!! $event->business->business_name !!}</td>
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
	</style>

	<script type="text/javascript">
		//var editor; // use a global for the submit and return data rendering in the examples
        //var $model_event = JSON.parse( '{!! (json_encode($model_event)) !!}' );

		$(document).ready(function() {
		    $("#table_event").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            /*$( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );*/
		} );
	</script>
@endsection
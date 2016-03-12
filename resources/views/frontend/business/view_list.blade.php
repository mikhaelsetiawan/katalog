@extends('frontend/view_frontend_index')

@section('popup')
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
		<table id="table_business" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
<!--					<th style="width: 115px;">Action</th>-->
					<th>Name</th>
					<th>Email</th>
					<th>Url</th>
					<th>Building</th>
					<th>Category</th>
					<th>Parent</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_business as $business)
					<tr>
						<td>
						  <a href="./detail/{!! $business['business_id'] !!}">
						    {!! $business['business_name'] !!}
						  </a>
            </td>
						<td>{!! $business['business_email'] !!}</td>
						<td>{!! $business['business_url'] !!}</td>
						<td>{!! $business->building['building_name'] !!}</td>
						<td>{!! $business->bfield['bfield_name'] !!}</td>
						<td>{!! $business->parentName() !!}</td>
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
        var $model_business = JSON.parse( '{!! (json_encode($model_business)) !!}' );

		$(document).ready(function() {
		    $("#table_business").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );
	</script>
@endsection
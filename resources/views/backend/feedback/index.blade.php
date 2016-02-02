@extends('backend.view_backend_index')

@section('popup')
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Feedback</h3>
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
		<table id="table_feedback" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Content</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_feedback as $feedback)
					<tr>
						<td>{!! $feedback->member->member_name !!}</td>
						<td>{!! $feedback->category->fcat_name !!}</td>
						<td>{!! $feedback->feedback_content !!}</td>
						<td>{!! date_format(new DateTime($feedback->created_at), 'd-M-Y H:i:s') !!}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('page-script')

	<style type="text/css" class="init">
        /*#dtcustom
        {
            display: inline-block;
        }*/
	</style>

	<script type="text/javascript">
		$(document).ready(function() {
		    $("#table_feedback").dataTable(
		        {
                "bAutoWidth":false,
//                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
		} );
	</script>
@endsection
@extends('backend.view_backend_index')
@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-confirm">
        <div class="popup-header"></div>
        <div class="popup-body">
            <form id="form-popup-confirm" class="form-horizontal" action="{{{ action('backend\controller_bclaim@editBclaim') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="2" />
                <input type="hidden" name="bclaim_id" id="confirm_key" value="" />
                <div class="form-group">
                    <div class="col-sm-12">
                        Are you sure wants to confirm this item?
                    </div>
                </div>
                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-confirm').submit()">
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
    <div class="popup-box" id="popup-reject">
        <div class="popup-header"></div>
        <div class="popup-body">
            <form id="form-popup-reject" class="form-horizontal" action="{{{ action('backend\controller_bclaim@editBclaim') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="bclaim_id" id="reject_key" value="" />
                <div class="form-group">
                    <div class="col-sm-12">
                        Are you sure wants to reject this item?
                    </div>
                </div>
                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-reject').submit()">
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
        <h3>Member Affiliation</h3>
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
		<table id="table_bclaim" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th>Business</th>
					<th>Member</th>
					<th>Role</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th style="width: 130px;">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_bclaim as $bclaim)
					<tr>
						<td>{!! $bclaim->business->business_name !!}</td>
						<td>{!! $bclaim->member->member_name !!}</td>
						<td>{!! $bclaim['bclaim_role'] !!}</td>
						<td>{!! $bclaim['bclaim_start_date'] !!}</td>
						<td>{!! $bclaim['bclaim_end_date'] !!}</td>
            <td>
              @if($bclaim['bclaim_status'] == 1)
              <div class="btn-group" style="" onclick='popupConfirm("{{{ $bclaim['bclaim_id'] }}}")'>
                <button type="button" class="btn btn-success btn-xs">
                  <span class="glyphicon glyphicon-ok"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Confirm</span>
                </button>
              </div>
              <div class="btn-group" style="" onclick='popupReject("{{{ $bclaim['bclaim_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-remove"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Reject</span>
                </button>
              </div>
              @elseif($bclaim['bclaim_status'] == 2)
                Confirmed
              @elseif($bclaim['bclaim_status'] == 3)
                Rejected
              @endif
            </td>
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
        var $model_bclaim = JSON.parse( '{!! (json_encode($model_bclaim)) !!}' );

		$(document).ready(function() {
		    $("#table_bclaim").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            /*$( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );*/
		} );

		/*function popupEdit(id,business_id,member_id,role,start_date,end_date)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_bclaim_id").val(id);
		    $("#edit_business_id").val(business_id);
		    $("#edit_member_id").val(member_id);
		    $("#edit_bclaim_role").val(role);
		    $("#edit_bclaim_start_date").val(start_date);
		    $("#edit_bclaim_end_date").val(end_date);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_bclaim_id").val("");
		    $("#edit_business_id").val("");
		    $("#edit_member_id").val("");
		    $("#edit_bclaim_role").val("");
		    $("#edit_bclaim_start_date").val("");
		    $("#edit_bclaim_end_date").val("");
		    openPopup("popup-edit");
		}

		function popupDelete(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_key").val(key);
		    openPopup("popup-delete");
		}*/

		function popupConfirm(key)
		{
		    $('.popup-header').html('Form Confirm Data');
		    $("#confirm_key").val(key);
		    openPopup("popup-confirm");
		}

		function popupReject(key)
		{
		    $('.popup-header').html('Form Reject Data');
		    $("#reject_key").val(key);
		    openPopup("popup-reject");
		}
	</script>
@endsection
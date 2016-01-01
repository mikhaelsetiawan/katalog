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
                'action'    => 'backend\controller_maff@editMaff'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="maff_id" id="edit_maff_id" value="" />

                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_id">Business : </label>
                  <div class="col-md-10">
                    {!! Form::select('business_id', $model_business, null, ['class' => 'form-control', 'id'=>'edit_business_id']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_id">Member : </label>
                  <div class="col-md-10">
                    {!! Form::select('member_id', $model_member, null, ['class' => 'form-control', 'id'=>'edit_member_id']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="maff_name">Role : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','maff_role',null, [
                                        'id'    => 'edit_maff_role',
                                        'class' => 'form-control',
                                        'placeholder' => 'Role'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="maff_name">Start Date : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','maff_start_date',null, [
                                        'id'    => 'edit_maff_start_date',
                                        'class' => 'form-control',
                                        'placeholder' => 'Start Date'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="maff_name">End Date : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','maff_end_date',null, [
                                        'id'    => 'edit_maff_end_date',
                                        'class' => 'form-control',
                                        'placeholder' => 'End Date'
                                        ]) !!}
                    </div>
                </div>

                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-edit').submit()">
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

    <div class="popup-box" id="popup-delete">
        <div class="popup-header"></div>
        <div class="popup-body">
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_maff@editMaff') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="maff_id" id="delete_key" value="" />
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
		<table id="table_maff" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th style="width: 115px;">Action</th>
					<th>Business</th>
					<th>Member</th>
					<th>Role</th>
					<th>Start Date</th>
					<th>End Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_maff as $maff)
					<tr>
            <td>
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $maff['maff_id'] }}}",
                  "{{{ $maff['business_id'] }}}",
                  "{{{ $maff['member_id'] }}}",
                  "{{{ $maff['maff_role'] }}}",
                  "{{{ $maff['maff_start_date'] }}}",
                  "{{{ $maff['maff_end_date'] }}}"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $maff['maff_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
            </td>
						<td>{!! $maff->business->business_name !!}</td>
						<td>{!! $maff->member->member_name !!}</td>
						<td>{!! $maff['maff_role'] !!}</td>
						<td>{!! $maff['maff_start_date'] !!}</td>
						<td>{!! $maff['maff_end_date'] !!}</td>
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
        var $model_maff = JSON.parse( '{!! (json_encode($model_maff)) !!}' );

		$(document).ready(function() {
		    $("#table_maff").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );

		function popupEdit(id,business_id,member_id,role,start_date,end_date)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_maff_id").val(id);
		    $("#edit_business_id").val(business_id);
		    $("#edit_member_id").val(member_id);
		    $("#edit_maff_role").val(role);
		    $("#edit_maff_start_date").val(start_date);
		    $("#edit_maff_end_date").val(end_date);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_maff_id").val("");
		    $("#edit_business_id").val("");
		    $("#edit_member_id").val("");
		    $("#edit_maff_role").val("");
		    $("#edit_maff_start_date").val("");
		    $("#edit_maff_end_date").val("");
		    openPopup("popup-edit");
		}

		function popupDelete(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_key").val(key);
		    openPopup("popup-delete");
		}
	</script>
@endsection
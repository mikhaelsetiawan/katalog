@extends('backend')

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
                'action'    => 'backend\controller_admin@editAdmin'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="admin_id" id="edit_admin_id" value="" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="admin_name">Name : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','admin_name',null, [
                                        'id'    => 'edit_admin_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Name'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="admin_email">Email : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','admin_email',null, [
                                        'id'    => 'edit_admin_email',
                                        'class' => 'form-control',
                                        'placeholder' => 'Email'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="admin_username">Username : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','admin_username',null, [
                                        'id'    => 'edit_admin_username',
                                        'class' => 'form-control',
                                        'placeholder' => 'Username'
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
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_admin@editAdmin') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="admin_id" id="delete_key" value="" />
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

    <div class="popup-box" id="popup-reset">
        <div class="popup-header"></div>
        <div class="popup-body">
            <form id="form-popup-reset" class="form-horizontal" action="{{{ action('backend\controller_admin@resetPass') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="admin_id" id="reset_key" value="" />
                <div class="form-group">
                    <div class="col-sm-12">
                        Are you sure wants to reset this admin password?
                    </div>
                </div>
                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="$('#form-popup-reset').submit()">
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
        <h3>Admin</h3>
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
		<table id="table_admin" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th style="width: 115px;">Action</th>
					<th>Name</th>
					<th>Email</th>
					<th>Username</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_admin as $admin)
					<tr>
            <td>
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $admin['admin_id'] }}}",
                  "{{{ $admin['admin_name'] }}}",
                  "{{{ $admin['admin_email'] }}}",
                  "{{{ $admin['admin_username'] }}}"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $admin['admin_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
              <div class="btn-group" style="margin-top: 5px;" onclick='popupReset("{{{ $admin['admin_id'] }}}")'>
                <button type="button" class="btn btn-success btn-xs" style="width: 126px;">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Reset</span>
                </button>
              </div>
            </td>
						<td>{!! $admin['admin_name'] !!}</td>
						<td>{!! $admin['admin_email'] !!}</td>
						<td>{!! $admin['admin_username'] !!}</td>
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
        var $model_admin = JSON.parse( '{!! (json_encode($model_admin)) !!}' );

		$(document).ready(function() {
		    $("#table_admin").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );

		function popupEdit(id,name,email,username)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_admin_id").val(id);
		    $("#edit_admin_name").val(name);
		    $("#edit_admin_email").val(email);
		    $("#edit_admin_username").val(username);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_admin_id").val("");
		    $("#edit_admin_name").val("");
		    $("#edit_admin_email").val("");
		    $("#edit_admin_username").val("");
		    openPopup("popup-edit");
		}

		function popupDelete(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_key").val(key);
		    openPopup("popup-delete");
		}

		function popupReset(key)
		{
		    $('.popup-header').html('Form Reset Data');
		    $("#reset_key").val(key);
		    openPopup("popup-reset");
		}
	</script>
@endsection
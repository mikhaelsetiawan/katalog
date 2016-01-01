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
                'action'    => 'backend\controller_member@editMember'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="member_id" id="edit_member_id" value="" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_name">Name : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','member_name',null, [
                                        'id'    => 'edit_member_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Name'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_email">Email : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','member_email',null, [
                                        'id'    => 'edit_member_email',
                                        'class' => 'form-control',
                                        'placeholder' => 'Email'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_username">Username : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','member_username',null, [
                                        'id'    => 'edit_member_username',
                                        'class' => 'form-control',
                                        'placeholder' => 'Username'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_birth_date">Birth Date : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','member_birth_date',null, [
                                        'id'    => 'edit_member_birth_date',
                                        'class' => 'form-control',
                                        'placeholder' => 'Birth Date'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_gender">Gender : </label>
                    <div class="col-sm-10">
                    {!! Form::select('member_gender',
                                    [
                                      'l'=>'Male',
                                      'f'=>'Female'
                                    ],
                                    [
                                      'id'    => 'edit_member_gender',
                                      'class' => 'form-control',
                                    ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_fb">Facebook : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','member_fb',null, [
                                        'id'    => 'edit_member_fb',
                                        'class' => 'form-control',
                                        'placeholder' => 'Facebook'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="member_coin">Coin : </label>
                    <div class="col-sm-10">
                        {!! Form::input('number','member_coin',null, [
                                        'id'    => 'edit_member_coin',
                                        'class' => 'form-control',
                                        'placeholder' => 'Coin'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city_code">City : </label>
                  <div class="col-md-10">
                    {!! Form::select('city_code', $model_city, null, ['class' => 'form-control', 'id'=>'edit_city_code']) !!}
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
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_member@editMember') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="member_id" id="delete_key" value="" />
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
            <form id="form-popup-reset" class="form-horizontal" action="{{{ action('backend\controller_member@resetPass') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="member_id" id="reset_key" value="" />
                <div class="form-group">
                    <div class="col-sm-12">
                        Are you sure wants to reset this member password?
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
        <h3>Member</h3>
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
		<table id="table_member" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead style="background-color: #EEEEEE;">
				<tr>
					<th style="width: 115px;">Action</th>
					<th>Name</th>
					<th>Email</th>
					<th>Username</th>
					<th>Birth Date</th>
					<th>Gender</th>
					<th>FB</th>
					<th>Coin</th>
					<th>City</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_member as $member)
					<tr>
            <td>
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $member['member_id'] }}}",
                  "{{{ $member['member_name'] }}}",
                  "{{{ $member['member_email'] }}}",
                  "{{{ $member['member_username'] }}}",
                  "{{{ $member['member_birth_date'] }}}",
                  "{{{ $member['member_gender'] }}}",
                  "{{{ $member['member_fb'] }}}",
                  "{{{ $member['member_coin'] }}}",
                  "{{{ $member->city->city_code }}}"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $member['member_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
              <br/>
              <div class="btn-group" style="margin-top: 5px;" onclick='popupReset("{{{ $member['member_id'] }}}")'>
                <button type="button" class="btn btn-success btn-xs" style="width: 126px;">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Reset</span>
                </button>
              </div>
            </td>
						<td>{!! $member['member_name'] !!}</td>
						<td>{!! $member['member_email'] !!}</td>
						<td>{!! $member['member_username'] !!}</td>
						<td>{!! $member['member_birth_date'] !!}</td>
						<td>{!! $member['member_gender'] !!}</td>
						<td>{!! $member['member_fb'] !!}</td>
						<td>{!! $member['member_coin'] !!}</td>
						<td>{!! $member->city->city_name !!}</td>
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
        var $model_member = JSON.parse( '{!! (json_encode($model_member)) !!}' );

		$(document).ready(function() {
		    $("#table_member").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );

    function resetPass()
    {

    }

		function popupEdit(id,name,email,username,birth_date,gender,fb,coin,city)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_member_id").val(id);
		    $("#edit_member_name").val(name);
		    $("#edit_member_email").val(email);
		    $("#edit_member_username").val(username);
		    $("#edit_member_birth_date").val(birth_date);
		    $("#edit_member_gender").val(gender);
		    $("#edit_member_fb").val(fb);
		    $("#edit_member_coin").val(coin);
		    $("#edit_city_code").val(city);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_member_id").val("");
		    $("#edit_member_name").val("");
		    $("#edit_member_email").val("");
		    $("#edit_member_username").val("");
		    $("#edit_member_birth_date").val("");
		    $("#edit_member_gender").val("");
		    $("#edit_member_fb").val("");
		    $("#edit_member_coin").val("");
		    $("#edit_city_code").val("");
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
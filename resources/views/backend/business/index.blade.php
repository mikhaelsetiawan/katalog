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
                'action'    => 'backend\controller_business@editBusiness'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="business_id" id="edit_business_id" value="" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="business_name">Name : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','business_name',null, [
                                        'id'    => 'edit_business_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Name'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="business_email">Email : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','business_email',null, [
                                        'id'    => 'edit_business_email',
                                        'class' => 'form-control',
                                        'placeholder' => 'Email'
                                        ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="business_email">Url : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','business_url',null, [
                                        'id'    => 'edit_business_url',
                                        'class' => 'form-control',
                                        'placeholder' => 'Url'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city_code">Building : </label>
                  <div class="col-md-10">
                    {!! Form::select('building_id', $model_building, null, ['class' => 'form-control', 'id'=>'edit_building_id']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city_code">Business Category : </label>
                  <div class="col-md-10">
                    {!! Form::select('bfield_id', $model_bfield, null, ['class' => 'form-control', 'id'=>'edit_bfield_id']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="city_code">Parent : </label>
                  <div class="col-md-10">
                    {!! Form::select('business_parent', $model_business_parent, null, ['class' => 'form-control', 'id'=>'edit_business_parent']) !!}
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
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_business@editBusiness') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="business_id" id="delete_key" value="" />
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
					<th style="width: 115px;">Action</th>
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
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $business['business_id'] }}}",
                  "{{{ $business['business_name'] }}}",
                  "{{{ $business['business_email'] }}}",
                  "{{{ $business['business_url'] }}}",
                  "{{{ $business->building['building_id'] }}}",
                  "{{{ $business->bfield['bfield_id'] }}}",
                  "{{{ $business['business_parent'] }}}"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $business['business_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
            </td>
						<td>{!! $business['business_name'] !!}</td>
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

		function popupEdit(id,name,email,url,building_id,bfield_id,parent)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_business_id").val(id);
		    $("#edit_business_name").val(name);
		    $("#edit_business_email").val(email);
		    $("#edit_business_url").val(url);
		    $("#edit_building_id").val(building_id);
		    $("#edit_bfield_id").val(bfield_id);
		    $("#edit_business_parent").val(parent);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_business_id").val("");
		    $("#edit_business_name").val("");
		    $("#edit_business_email").val("");
		    $("#edit_business_url").val("");
		    $("#edit_building_id").val("");
		    $("#edit_bfield_id").val("");
		    $("#edit_business_parent").val("");
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
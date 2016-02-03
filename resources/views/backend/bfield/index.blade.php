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
                'action'    => 'backend\controller_bfield@editBfield'
                )) !!}
                <input type="hidden" name="_type" id="_type" value="" />
                <input type="hidden" name="bfield_id" id="edit_bfield_id" value="" />
                <div class="form-group">
                    <label class="control-label col-sm-2" for="bfield_name">Name : </label>
                    <div class="col-sm-10">
                        {!! Form::input('text','bfield_name',null, [
                                        'id'    => 'edit_bfield_name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Name'
                                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="bfield_parent">Parent : </label>
                  <div class="col-md-10">
                    {!! Form::select('bfield_parent', $model_bfield_parent, null, ['class' => 'form-control', 'id'=>'edit_bfield_parent']) !!}
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="bfield_parent">Rating : </label>
                    <div class="col-md-10">
                      {!! Form::select('', $model_rating, null, ['class' => 'form-control', 'id'=>'select_rating_category']) !!}
                      <input name="bfield_rating" type="hidden" id="rating_category"/>
                      <input class="btn-xs btn btn-primary" type="button" value="Add Rating Category" id="btn_add_category">
                      <div id="div_rating_category"></div>
                    </div>
                </div>

                <div class="popup-buttons">
                    <div class="btn-group fr" onclick="submitForm()">
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
            <form id="form-popup-delete" class="form-horizontal" action="{{{ action('backend\controller_bfield@editBfield') }}}" method="post" role="form">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="_type" value="3" />
                <input type="hidden" name="bfield_id" id="delete_key" value="" />
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
        <h3>Business Field</h3>
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
		<table id="table_bfield" style="width:100%" class="table table-striped table-bordered dataTable table-hover no-footer">
			<thead>
				<tr>
					<th style="width: 115px;">Action</th>
					<th>Name</th>
					<th>Parent</th>
					<th>Rating</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model_bfield as $bfield)
				  <?php
				    $ratingName = '';
				    $ratingId = '';
				    $ratings = $bfield->rating();
				    for($i = 0; $i < count($ratings); $i++)
				    {
				      $ratingName .= $ratings[$i]->rating_name;
				      $ratingId .= $ratings[$i]->rating_id;
				      if($i < (count($ratings) - 1) )
				      {
				        $ratingName .= ',';
				        $ratingId .= ',';
				      }
				    }
          ?>
					<tr>
            <td>
              <div class="btn-group" onclick='
                  popupEdit(
                  "{{{ $bfield['bfield_id'] }}}",
                  "{{{ $bfield['bfield_name'] }}}",
                  "{{{ $bfield['bfield_parent'] }}}",
                  "<?= $ratingId ?>",
                  "<?= $ratingName ?>"
                  )'>
                  <button type="button" class="btn btn-primary btn-xs">
                      <span class="glyphicon glyphicon-edit"></span>
                      <span class="hidden-xs" style="margin-left: 6px;">Edit</span>
                  </button>
              </div>
              <div class="btn-group" style="margin-left: 5px;" onclick='popupDelete("{{{ $bfield['bfield_id'] }}}")'>
                <button type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs" style="margin-left: 5px;">Delete</span>
                </button>
              </div>
            </td>
						<td>{!! $bfield['bfield_name'] !!}</td>
						<td>{!! $bfield->parentName() !!}</td>
						<td><?= $ratingName ?></td>
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
        var $model_bfield = JSON.parse( '{!! (json_encode($model_bfield)) !!}' );
        var ratingId = [];
        var ratingName = [];
		$(document).ready(function() {
		    $('#btn_add_category').click(function()
		    {
		      var selectedRating = $("#select_rating_category").val();
		      var selectedRatingText = $("#select_rating_category option:selected").text();
		      if($.inArray(selectedRating,ratingId) == -1)
		      {
		        //not found
		        ratingId.push(selectedRating);
		        ratingName.push(selectedRatingText);

		        var ratingString = '<button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px;margin-right:5px;" id="rating_category_'+selectedRating+'" onclick="removeRatingCategory('+selectedRating+')">' +
		                        '<span class="hidden-sm" style="margin-left: 6px;margin-right: 6px;">'+selectedRatingText+'</span>' +
		                        '<span class="glyphicon glyphicon-remove"></span>' +
		                      '</button>';
		        $("#div_rating_category").append(ratingString);
		      }else
		      {
		        alert("Already added!");
		      }
		    });

		    $("#table_bfield").dataTable(
		        {
                "bAutoWidth":false,
                "dom": 'l<"#dtcustom">frtip'
		        }
		    );
            $( "div#dtcustom" ).html(
                '<div onclick="popupSave()" class="btn-group" style="margin-left:10px;"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span>&nbsp; New Data</button></div>'
            );
		} );

    function submitForm()
    {
      $("#rating_category").val(ratingId.join(","));
      $('#form-popup-edit').submit();
    }

    function removeRatingCategory(id)
    {
      var index = '';
      for(var i = 0; i < ratingId.length; i++)
      {
        if(ratingId[i] == id)
        {
          index = i;
          break;
        }
      }
      ratingId.splice(index,1);
      ratingName.splice(index,1);
      $("#div_rating_category #rating_category_"+id).remove();
    }

		function popupEdit(id,name,parent,inputRatingId,inputRatingName)
		{
		    $('.popup-header').html('Form Edit Data');
		    $("#_type").val('2');
		    $("#edit_bfield_id").val(id);
		    $("#edit_bfield_name").val(name);
		    $("#edit_bfield_parent").val(parent);

		    ratingId = inputRatingId.split(",");
		    ratingName = inputRatingName.split(",");

		    var ratingString = '';
		    for(var i=0; i < ratingId.length; i++)
		    {
		      ratingString += '<button type="button" class="btn btn-danger btn-xs" style="margin-top: 5px;margin-right:5px;" id="rating_category_'+ratingId[i]+'" onclick="removeRatingCategory('+ratingId[i]+')">' +
		                        '<span class="hidden-sm" style="margin-left: 6px;margin-right: 6px;">'+ratingName[i]+'</span>' +
		                        '<span class="glyphicon glyphicon-remove"></span>' +
		                      '</button>';
		    }
		    $("#div_rating_category").html('');
		    $("#div_rating_category").append(ratingString);
		    openPopup("popup-edit");
		}

		function popupSave()
		{
		    $('.popup-header').html('Form New Data');
		    $("#_type").val('1');
		    $("#edit_bfield_id").val("");
		    $("#edit_bfield_name").val("");
		    $("#edit_bfield_parent").val("");
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
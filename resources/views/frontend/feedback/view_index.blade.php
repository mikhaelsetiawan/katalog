@extends('app')

@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-delete-feedback">
        <div class="popup-header"></div>
        <div class="popup-body">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="_type" id="delete_feedback_type" value="2" />
            <input type="hidden" name="business_id" id="delete_feedback_key" value="" />
            <div class="form-group">
                <div class="col-sm-12">
                    Are you sure wants to delete this feedback?
                </div>
            </div>
            <div class="popup-buttons" style="margin-top: 30px;">
                <div class="btn-group fr" onclick="deleteFeedback()">
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
            <div class="cb"></div>
        </div>
    </div>
  </div>
@endsection

@section('page-script')

	{!! Html::style('css/frontend/feedback.css') !!}
	<style type="text/css" class="init">
	</style>

<script>
    $(document).ready(function()
    {
      $("#button_post_feedback").click(function()
      {
        var callbackSubmitFeedback = function(data) {

          if(data == 0)
          {
            alert("Post feedback failed.");
          }else
          {
            data = $.parseJSON(data);

            var item = '<div class="item" id="feedback_'+data.feedback_id+'">' +
                          '<p class="title">Category : '+$('#add_fcat_id  option:selected').text()+'</p>' +
                          '<p class="content">'+$('#add_feedback_content').val()+'</p>';

            item += '<p class="date">' +
                        '<span class="button_delete">Delete</span>' +
                        data.created_at+
                      '</p>' +
                    '</div>';

            if(jumFeedback == 0)
            {
              $('.div_feedback').html('');
            }

            $('.div_feedback').prepend(item);
            $('#add_fcat_id').val("1");
            $('#add_feedback_content').val("");
            jumFeedback++;
          }
        };
        $.post('{{ action('controller_feedback@submitFeedback') }}',
              {
                _token:'{{ csrf_token() }}',
                _type:1,
                member_id:'{{ $member_id }}',
                fcat_id:$('#add_fcat_id').val(),
                feedback_content:$('#add_feedback_content').val()
              },function(data)
              {
              callbackSubmitFeedback(data);
            });
      });
    });

		function popupDeleteFeedback(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_feedback_key").val(key);
		    openPopup("popup-delete-feedback");
		}

		function deleteFeedback()
		{
        $.post('{{ action('controller_feedback@submitFeedback') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:3,
                  feedback_id: $('#delete_feedback_key').val()
                },function(data)
        {
          if(data == 1)
          {
            jumFeedback--;
            $('#feedback_'+$('#delete_feedback_key').val()).remove();
            if(jumFeedback <= 0)
            {
              $('.div_feedback').html('');
              $('.div_feedback').append('<div class="ce">No feedback found.</div>');
            }
            $('#delete_feedback_key').val("");
            closePopup();
          }
        });
		}
</script>
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
  <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
    <table id="table_addFeedback" style="width:100%;" class="">
      <colgroup>
        <col style="width: 150px;"/>
        <col style="width: 10px;"/>
        <col style=""/>
      </colgroup>
      <tr>
        <td>Category</td>
        <td>:</td>
        <td>
          {!! Form::select('', $model_fcat, null, ['style'=>'width:340px','class' => 'form-control pull-left','id'=>'add_fcat_id']) !!}
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top;">Content</td>
        <td style="vertical-align: top;">:</td>
        <td>
          {!! Form::textarea('feedback_content', null, [
                          'id'    => 'add_feedback_content',
                          'class' => 'form-control',
                          'placeholder' => 'Content',
                          'style' => 'resize:vertical;',
                          'rows' => 2,
                          'cols' => 40
                            ]) !!}
        </td>
      </tr>
      <tr>
        <td colspan="2"></td>
        <td>
          <button type="button" id="button_post_feedback" class="btn btn-success fr">Post</button>
        </td>
      </tr>
    </table>
    <h3>Your previous feedback</h3>
    <div class="div_feedback">
      <?php $isEmpty = 0; ?>
      @foreach($model_member->feedback as $feedback)
        <?php $isEmpty++; ?>
        <div class="item" id="feedback_{!! $feedback->feedback_id !!}">
          <p class="title">Category : {!! $feedback->category->fcat_name !!}</p>
          <p class="content">{!! $feedback->feedback_content !!}</p>
          <p class="date">
            <span class="button_delete" onclick="popupDeleteFeedback({!! $feedback->feedback_id !!})">Delete</span>
            {!! date_format(new DateTime($feedback->created_at), 'd-M-Y H:i:s') !!}
          </p>
        </div>
      @endforeach
      @if($isEmpty == 0)
        <div class="ce">No feedback found.</div>
      @else
        <?= "<script>jumFeedback = ".$isEmpty.";</script>"; ?>
      @endif
    </div>
  </div>
</div>
@endsection
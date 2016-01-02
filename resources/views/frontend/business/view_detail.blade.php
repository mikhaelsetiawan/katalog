@extends('app')

@section('popup')
<div class="popup-overlay">
    <div class="popup-box" id="popup-delete-news">
        <div class="popup-header"></div>
        <div class="popup-body">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="hidden" name="_type" id="delete_news_type" value="2" />
            <input type="hidden" name="business_id" id="delete_news_key" value="" />
            <div class="form-group">
                <div class="col-sm-12">
                    Are you sure wants to delete this news?
                </div>
            </div>
            <div class="popup-buttons" style="margin-top: 30px;">
                <div class="btn-group fr" onclick="deleteNews()">
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

	{!! Html::style('css/frontend/business.css') !!}
	<style type="text/css" class="init">
        #dtcustom
        {
            display: inline-block;
        }
	</style>

  <script>
    $(document).ready(function()
    {
      $('#button_klaim').click(function()
      {
        $('#div_klaim').show();
        $('#button_klaim').hide();
      });
      $('#button_post_news').click(function()
      {
        $.post('{{ action('controller_business@submitAddNews') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:1,
                  member_id:'{{ $member_id }}',
                  business_id:'{{ $business->business_id }}',
                  news_title:$('#edit_news_title').val(),
                  news_content:$('#edit_news_content').val()
                },function(data)
        {
          data = $.parseJSON(data);
          var item = '<div class="item" id="news_'+data.news_id+'">' +
                        '<p class="title">'+$('#edit_news_title').val()+'</p>' +
                        '<p class="content">'+$('#edit_news_content').val()+'</p>' +
                        '<p class="date">' +
                          '<span class="button_edit">Edit</span>' +
                          '<span class="button_delete">Delete</span>' +
                          data.created_at+
                        '</p>' +
                      '</div>';
          $('.div_news').prepend(item);
          $('#edit_news_title').val("");
          $('#edit_news_content').val("");
        });
      });
    });

		function popupDeleteNews(key)
		{
		    $('.popup-header').html('Form Delete Data');
		    $("#delete_news_key").val(key);
		    openPopup("popup-delete-news");
		}

		function deleteNews()
		{
        $.post('{{ action('controller_business@submitAddNews') }}',
                {
                  _token:'{{ csrf_token() }}',
                  _type:3,
                  news_id: $('#delete_news_key').val()
                },function(data)
        {
          if(data == 1)
          {
            $('#news_'+$('#delete_news_key').val()).remove();
            $('#delete_news_key').val("");
            closePopup();
          }
        });
		}
  </script>
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
		<table id="table_business" style="width:100%" class="table">
		  <colgroup>
		    <col style="width: 150px;"/>
		    <col style="width: 10px;"/>
		    <col style=""/>
		  </colgroup>
			<thead>
				{{--<tr>--}}
{{--<!--					<th style="width: 115px;">Action</th>-->--}}
					{{--<th>Name</th>--}}
					{{--<th>Email</th>--}}
					{{--<th>Url</th>--}}
					{{--<th>Building</th>--}}
					{{--<th>Category</th>--}}
					{{--<th>Parent</th>--}}
				{{--</tr>--}}
			</thead>
			<tbody>
				{{--@foreach($model_business as $business)--}}
					<tr>
					  <td>Name</td>
					  <td>:</td>
						<td>{!! $business['business_name'] !!}</td>
          </tr>
          <tr>
					  <td>Email</td>
					  <td>:</td>
						<td>{!! $business['business_email'] !!}</td>
          </tr>
          <tr>
					  <td>Url</td>
					  <td>:</td>
						<td>{!! $business['business_url'] !!}</td>
          </tr>
          <tr>
					  <td>Location</td>
					  <td>:</td>
						<td>{!! $business->building->building_name.', '.$business->building->city->city_name !!}</td>
          </tr>
          <tr>
					  <td>Type</td>
					  <td>:</td>
						<td>{!! $business->bfield['bfield_name'] !!}</td>
          </tr>
          <tr>
					  <td>Parent</td>
					  <td>:</td>
						<td>{!! $business->parentName() !!}</td>
          </tr>
          <tr>
					  <td>Owner</td>
					  <td>:</td>
						<td>
						  <?php $count=0; ?>
						  @if(count($business->maff) > 0)
						    @foreach($business->maff as $maff)
						      {!! $maff->member->member_name !!}
						      @if($count < count($business->maff)-1)
						        {!! ', ' !!}
						      @endif
						      <?php $count++; ?>
						    @endforeach
						  @elseif($alreadyClaim > 0)
                {!! 'In Process' !!}
						  @else
                {!! Form::open(array(
                    'class'     => 'form-horizontal',
                    'id'        => 'form-popup-edit',
                    'method'    => 'POST',
                    'action'    => 'controller_business@submitClaimBusiness'
                    )) !!}
                    <input type="hidden" name="business_id" value="{!! $business['business_id'] !!}"/>
                    <button type="button" id="button_klaim" class="btn btn-primary">Klaim</button>
                    <div id="div_klaim" style="display: none;">
                      <table>
                        <colgroup>
                          <col style="width: 150px;"/>
                          <col style="width: 10px;"/>
                          <col style=""/>
                        </colgroup>
                        <tbody>
                          <tr>
                          	<td>Role</td>
                          	<td>:</td>
                          	<td>
                          	{!! Form::input('text','bclaim_role',null, [
                                            'id'    => 'edit_bclaim_role',
                                            'class' => 'form-control',
                                            'placeholder' => 'Role'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td>Bukti Usaha</td>
                          	<td>:</td>
                          	<td>
                          	<input type="file" class=""/>
                          	</td>
                          </tr>
                          <tr>
                          	<td>Start date</td>
                          	<td>:</td>
                            <td>
                            {!! Form::input('text','bclaim_start_date',null, [
                                            'id'    => 'edit_bclaim_start_date',
                                            'class' => 'form-control',
                                            'placeholder' => 'Start Date'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td>End date</td>
                          	<td>:</td>
                            <td>
                              {!! Form::input('text','bclaim_end_date',null, [
                                            'id'    => 'edit_bclaim_end_date',
                                            'class' => 'form-control',
                                            'placeholder' => 'End Date'
                                            ]) !!}
                          	</td>
                          </tr>
                          <tr>
                          	<td colspan="3">
                              <button type="submit" id="" class="btn btn-success">Submit</button>
                          	</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                {!! Form::close() !!}
						  @endif
						</td>
          </tr>
				{{--@endforeach--}}
			</tbody>
		</table>
	</div>
    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 50px;">
      <h3>News</h3>

      @if($isOwner > 0)
        <table id="table_addNews" style="width:100%;" class="">
          <colgroup>
            <col style="width: 150px;"/>
            <col style="width: 10px;"/>
            <col style=""/>
          </colgroup>
          <tr>
            <td>Title</td>
            <td>:</td>
            <td>
              {!! Form::input('text','news_title',null, [
                              'id'    => 'edit_news_title',
                              'class' => 'form-control',
                              'placeholder' => 'Title'
                              ]) !!}
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top;">Content</td>
            <td style="vertical-align: top;">:</td>
            <td>
              {!! Form::textarea('news_content', null, [
                              'id'    => 'edit_news_content',
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
              <button type="button" id="button_post_news" class="btn btn-success fr">Post</button>
            </td>
          </tr>
        </table>
      @endif
      <div class="div_news">
        @foreach($business->news as $news)
          <div class="item" id="news_{!! $news->news_id !!}">
            <p class="title">{!! $news->news_title !!}</p>
            <p class="content">{!! $news->news_content !!}</p>
            <p class="date">
              <span class="button_edit">Edit</span>
              <span class="button_delete" onclick="popupDeleteNews({!! $news->news_id !!})">Delete</span>
              {!! date_format(new DateTime($news->created_at), 'd-M-Y H:i:s') !!}
            </p>
          </div>
        @endforeach
      </div>
    </div>
</div>
@endsection
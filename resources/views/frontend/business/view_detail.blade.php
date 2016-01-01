@extends('app')

@section('page-script')

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
    });
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
</div>
@endsection
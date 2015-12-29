@extends('app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
            {!! Form::open(array(
                'class'     => 'form-horizontal',
                'id'        => 'form-popup-edit',
                'method'    => 'POST',
                'action'    => 'controller_frontend@submitRegister'
                )) !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
                  {!! Form::input('text','member_name',null, [
                                  'id'    => 'name',
                                  'class' => 'form-control',
                                  'placeholder' => 'Name'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
                  {{--<input class="form-control" value="{{ old('member_email')  }}" type="email" name="member_email" id="email"/>--}}
                  {!! Form::input('email','member_email',null, [
                                  'id'    => 'email',
                                  'class' => 'form-control',
                                  'placeholder' => 'Email'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
{{--                  <input class="form-control" value="{{ old('member_username')  }}" type="text" name="member_username" id="username"/>--}}
                  {!! Form::input('text','member_username',null, [
                                  'id'    => 'username',
                                  'class' => 'form-control',
                                  'placeholder' => 'Username'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									{{--<input type="password" class="form-control" name="member_password" id="password">--}}
                  {!! Form::input('password','member_password',null, [
                                  'id'    => 'password',
                                  'class' => 'form-control',
                                  'placeholder' => 'Password'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									{{--<input type="password" class="form-control" name="member_confirmPassword" id="confirmPassword">--}}
                  {!! Form::input('password','member_password_confirmation',null, [
                                  'id'    => 'password_confirmation',
                                  'class' => 'form-control',
                                  'placeholder' => 'Confirm Password'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Birth Date</label>
								<div class="col-md-6">
                  {{--<input class="form-control" value="{{ old('member_birth_date')  }}" type="text" name="member_birth_date" id="birth_date"/>--}}
                  {!! Form::input('text','member_birth_date',null, [
                                  'id'    => 'birth_date',
                                  'class' => 'form-control',
                                  'placeholder' => 'Birth Date'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Gender</label>
								<div class="col-md-6">
								  {!! Form::select('member_gender',
								                  [
								                    'l'=>'Male',
								                    'f'=>'Female'
                                  ],
								                  [
                                    'id'    => 'gender',
                                    'class' => 'form-control',
                                  ]) !!}
                  {{--<select name="member_gender" id="gender">
                    <option value="l">Male</option>
                    <option value="p">Female</option>
                  </select>--}}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Facebook</label>
								<div class="col-md-6">
                  {!! Form::input('text','member_fb',null, [
                                  'id'    => 'fb',
                                  'class' => 'form-control',
                                  'placeholder' => 'Facebook'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">City</label>
								<div class="col-md-6">
								  {!! Form::select('city_code', $model_city, null, ['class' => 'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
            {!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

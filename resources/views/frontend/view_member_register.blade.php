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
                                  'value' => old('member_name'),
                                  'placeholder' => 'Name'
                                  ]) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
                  <input class="form-control" value="{{ old('member_email')  }}" type="email" name="member_email" id="email"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
                  <input class="form-control" value="{{ old('member_username')  }}" type="text" name="member_username" id="username"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="member_password" id="password">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="member_confirmPassword" id="confirmPassword">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Birth Date</label>
								<div class="col-md-6">
                  <input class="form-control" value="{{ old('member_birth_date')  }}" type="text" name="member_birth_date" id="birth_date"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Gender</label>
								<div class="col-md-6">
                  <select name="member_gender" id="gender">
                    <option value="l">Male</option>
                    <option value="p">Female</option>
                  </select>
								</div>
							</div>

							{{--<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember"> Remember Me
										</label>
									</div>
								</div>
							</div>--}}

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">Login</button>

									{{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}
								</div>
							</div>
            {!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

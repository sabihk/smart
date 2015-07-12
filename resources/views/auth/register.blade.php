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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}"
						id="register_user_form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>First Name
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>Last Name
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>E-Mail Address
							</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
								<div id="email_error" class="text-danger"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>Password
							</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>Confirm Password
							</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>Birthday
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control datepicker cursor" readonly
								name="birthday" value="{{ old('birthday') }}" data-date-format="dd-mm-yyyy">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">
								<span class="required">*</span>Phone Number
							</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_number"
								maxlength="20" value="{{ old('phone_number') }}">
								<div id="phone_number_error" class="text-danger"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Website</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="website" value="{{ old('website') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary btn_register_user">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

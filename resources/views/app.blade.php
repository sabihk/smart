<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Smart</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugins/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/plugins/datepicker/css/datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/smart.css') }}" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">smart&geek</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome {{ Auth::user()->first_name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	<script src="{{ asset('/scripts/jquery.min.js') }}"></script>
	<script src="{{ asset('/scripts/bootstrap.min.js') }}"></script>
	<script>
		var base = "{{ URL::to('/') }}";
	</script>
	<script src="{{ asset('/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('/scripts/smart.js') }}"></script>
</body>
</html>

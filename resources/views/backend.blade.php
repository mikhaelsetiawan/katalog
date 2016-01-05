<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MaxelID - Catalog</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/main.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    <style type="text/css">
      #map { height: 100%; }
    </style>
</head>
<body>
@yield('popup')
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Catalog</a>
			</div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      {{--<ul class="nav navbar-nav">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{url('/backend/compro')}}">Company Profile</a></li>
            <li><a href="{{url('/backend/portfolio')}}">Portfolio</a></li>
            <li><a href="{{url('/backend/client')}}">Client</a></li>
          </ul>
        </li>
      </ul>--}}

        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
          {{--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            </ul>
          </li>--}}
        </ul>
      </div>
		</div>
	</nav>

	<!-- Scripts -->
	{!! Html::style('js/DataTable/media/css/font-awesome.min.css') !!}
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	{!! Html::style('js/DataTable/media/css/jquery.dataTables.min.css') !!}
	{!! Html::style('js/DataTable/media/css/dataTables.tableTools.css') !!}

	{!! Html::script('js/main.js'); !!}
	{!! Html::script('js/DataTable/media/js/jquery.dataTables.min.js'); !!}
	{!! Html::script('js/DataTable/media/js/dataTables.tableTools.min.js'); !!}
	@yield('content')
	@yield('page-script')asdfadsfasdf
    <div id="map"></div>
    <script type="text/javascript">

var map;
function initMap() {
alert('z');
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}

		$(document).ready(function() {
		    initMap();
		});
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EnG_QKTlVAVCEkfba_rlej5-rbC0sSI&callback=initMap">
    </script>


</body>
</html>

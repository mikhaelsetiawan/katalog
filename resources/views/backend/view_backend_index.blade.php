<!DOCTYPE html>
<html>
    <head>
        <title>Katalog Backend</title>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

          <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
          <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

          {!! Html::script('js/main.js'); !!}
          {!! Html::style('js/DataTable/media/css/font-awesome.min.css') !!}
          {!! Html::style('js/DataTable/media/css/jquery.dataTables.min.css') !!}

          {!! Html::style('js/DataTable/media/css/dataTables.tableTools.css') !!}
          {!! Html::script('js/DataTable/media/js/jquery.dataTables.min.js'); !!}
          {!! Html::script('js/DataTable/media/js/dataTables.tableTools.min.js'); !!}


        <link href="{{ asset('/css/style_backend.css') }}" rel="stylesheet">
    </head>
    <body>
      @yield('popup')
      @include('backend.view_backend_header')
      <nav>
        <ul>
          <li onclick="$('#master_sub').slideToggle();">
            <span class=" glyphicon glyphicon-list-alt" aria-hidden="true"></span>
            Master
          </li>
        </ul>
            <ul class="sub" id="master_sub">
              <a href="{{ action('backend\controller_member@index') }}"><li> Member </li></a>
              <a href="business"><li> Business </li></a> 
              <a href="bfield"><li> Fields </li></a> 
              <a href="building"><li> Building </li></a> 
              <a href="country"><li> Country </li></a> 
              <a href="province"><li> Province </li></a> 
              <a href="city"><li> City </li></a> 
            </ul>
      </nav>
      <main>
        @yield('content')
      @yield('page-script')
      </main>
      
      
    </body>
</html>

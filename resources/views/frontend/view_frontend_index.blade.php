<!DOCTYPE html>
<html>
    <head>
        <title>Katalog Bisnis Online</title>
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


        <link href="{{ asset('/css/style_frontend.css') }}" rel="stylesheet">
    </head>
    <body>
      @yield('popup')
      @include('frontend.view_frontend_header')
      @include('frontend.view_frontend_nav_top')
      <style>
        
      </style>
      <nav class="nav_left">
        <ul>
          <li>1</li>
          <li>2</li>
          <li>3</li>
        </ul>
      </nav>
      <main>
        @yield('content')
        <section>
          <div class="items">
            <img src="http://blogjob.com/oneangrygamer/files/2015/10/Image185-585x300.jpg">
          </div>
        </section>
        
        @yield('page-script')
      </main>          
    </body>
</html>


<!DOCTYPE html>
<html>
    <head>
        <title>Katalog</title>
          <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

          <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
          <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

            <script>
                var urlBase = '<?= URL::to('/'); ?>';
            </script>

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
      <div class="popup-overlay-report">

        <div class="popup-box-report" id="popup-report-result">
            <div class="popup-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="popup-report-content">Report submited.</span>
                    </div>
                </div>
                <div class="popup-buttons" style="margin-top: 30px;">
                    <div class="btn-group fr" onclick="closePopupReport()">
                        <button type="submit" class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-ok"></span>
                            <span class="hidden-sm" style="margin-left: 6px;">OK</span>
                        </button>
                    </div>
                </div>
                <div class="cb"></div>
            </div>
        </div>

        <div class="popup-box-report" id="popup-report-this">
            <div class="popup-header">Report this</div>
            <div class="popup-body">
                <input type="hidden" name="_token" id="report_token" value="{{{ csrf_token() }}}" />
                <input type="hidden" name="report_target_type" id="report_target_type" value="" />
                <input type="hidden" name="report_target_id" id="report_target_id" value="" />
                <div class="form-group">
                    <div class="col-sm-2">
                        Report :
                    </div>
                    <div class="col-sm-10">
                        {!! Form::select('reportcat_id', $reportcat, null, ['style'=>'width:300px','class' => 'form-control','id'=>'reportcat_id']) !!}
                        {!! Form::textarea('report_content', '', [
                                        'id'    => 'report_content',
                                        'class' => 'form-control',
                                        'placeholder' => 'Report this because..',
                                        'style' => 'resize:vertical;',
                                        'rows' => 2,
                                        'cols' => 40
                                        ]) !!}
                    </div>
                    <div class="cb"></div>
                </div>
                <div class="popup-buttons" style="margin-top: 30px;">
                    <div class="btn-group fr" onclick="submitReport()">
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
                    <div class="popup-buttons-pleasewait" style="display: none;">
                        <span class='pull-right'>Please wait..</span>
                    </div>
                </div>
                <div class="cb"></div>
            </div>
        </div>
      </div>
      @include('frontend.view_frontend_header')
      @include('frontend.view_frontend_nav')


        @yield('content')
      @yield('page-script')
      </main>
      
      
    </body>
</html>


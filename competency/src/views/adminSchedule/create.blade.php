@section('customcss')
    {{ HTML::style('assets/bootstrap-datepicker/css/datepicker.css') }}
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tambah Data Tipe Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah atau merubah jadwal kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                    <div class="form-group @if ($errors->has('year')) has-error @endif">
                        <label class="control-label col-md-2">Tahun</label>
                        <div class="col-md-6 col-xs-11">
                            <input type="text" size="16" class="form-control dpMonths" data-date-minviewmode="years" data-date-viewmode="years" data-date-format="yyyy " value="{{ $schedule->year }}" />
                            @if ($errors->has('year'))<span class="help-block">{{ $errors->first('year') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('date_start')) has-error @endif">
                        <label class="control-label col-md-2">Tanggal Mulai</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" name="date_start" value="{{ $schedule->date_start }}"/>
                            @if ($errors->has('date_start'))<span class="help-block">{{ $errors->first('date_start') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('date_end')) has-error @endif">
                        <label class="control-label col-md-2">Tanggal Selesai</label>
                        <div class="col-md-6 col-xs-11">
                            <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" name="date_end" value="{{ $schedule->date_end }}" />
                            @if ($errors->has('date_end'))<span class="help-block">{{ $errors->first('date_end') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('status')) has-error @endif">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-md-6 col-xs-11">
                            <select class="form-control">
                                <option value="pending" @if($schedule->status == "pending") selected="selected" @endif>tunda</option>
                                <option value="active" @if($schedule->status == "active") selected="selected" @endif>aktif</option>
                                <option value="archive" @if($schedule->status == "archive") selected="selected" @endif>arsip</option>
                            </select>
                            @if ($errors->has('status'))<span class="help-block">{{ $errors->first('status') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-danger">simpan</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </section>
        </div>
    </div>
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    {{ HTML::script('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_sch").addClass("active");
        $( "#help_app" ).tooltip();
        $('.default-date-picker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.dpMonths').datepicker();
    </script>
@stop
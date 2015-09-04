@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tambah Data Tipe Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah daftar tipe kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label class="control-label col-md-2">Nama</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Nama Tipe kompetensi" name="name">
                                @if ($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}.</span>@endif
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
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_typ").addClass("active");
        $( "#help_app" ).tooltip();
    </script>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Rekap Hasil Pengukuran Kompetensi Karyawan
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk merekap hasil penilaian kompetensi aktif"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <div class="col-lg-12">
                        @if (!empty($message))
                            <div class="alert alert-warning fade in">
                                <strong>Terdapat kesalahan</strong>:
                                <ol>{{ $message }}</ol>
                            </div>
                        @endif

                        @if (Session::has('message2'))
                            <div class="alert alert-info fade in">
                                <strong>Pesan</strong>:
                                {{ Session::get('message2') }}
                            </div>
                        @endif

                        {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                        <div class="form-group"><b>tanda <em style="color:#FF0000;">*</em> wajib diisi</b></div>
                        <div class="form-group">
                            <label for="tahun" class="col-lg-2 col-sm-2 control-label">Tahun<em style="color:#FF0000;">*</em></label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $competency->year }}" readonly>
                            </div>
                        </div>

                        <button type="submit" id="tombol" class="btn btn-success">Submit</button>
                        {{ Form::close() }}
                    </div>
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
    <script>
        $("#menu_comp").addClass("active");
        $("#menu_comp_rec").addClass("active");
        $( "#help_app" ).tooltip();
        $(document).ready(function(){
            $("#tombol").click(function () {
                var flag = confirm("Proses dapat membutuhkan waktu yang lama. Anda yakin ingin melanjutkan?");
                if(flag==false) return false;
                $("form[name=dform]").submit();
            });
        });
    </script>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Hasil Pengukuran Kompetensi Karyawan
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
                                <select class="form-control" name="competency">
                                    @foreach($competencyAll as $row)
                                        <option value="{{ $row->id }}">{{ $row->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" id="tombol" class="btn btn-success">Submit</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </section>
        </div>
    </div>

    @if(isset($recap))
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <section class="panel">
                    <div class="panel-body">
                        <input class="knob" data-displayPrevious=true  data-thickness=".2" value="{{ $competency->value }}" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan Saat Pengukuran</th>
                                <th>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recap as $rowRecap)
                                <tr>
                                    <td>{{ $rowRecap->pegawai->nama }}</td>
                                    <td>{{ $rowRecap->jabatan->nama_lengkap }}</td>
                                    <td>{{ $rowRecap->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    @endif
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script src="{{asset('/assets/jquery-knob/js/jquery.knob.js')}}"></script>
    <script>
        $("#menu_comp").addClass("active");
        $("#menu_comp_res").addClass("active");
        $(document).ready(function(){
            $( "#help_app" ).tooltip();

            $(".knob").knob({
                "readOnly": true
            });
        });
    </script>
@stop
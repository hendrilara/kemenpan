@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Profil Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk melihat hasil penilaian kompetensi per tahun"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
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
                                <select class="form-control" id="tahun" name="competency_id">
                                    @foreach($competency as $rowCompetency)
                                    <option value="{{ $rowCompetency->id }}">{{ $rowCompetency->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" id="tombol" class="btn btn-success">Submit</button>
                        {{ Form::close() }}
                </div>
            </section>
        </div>
    </div>

    @if(isset($result))
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $masterPegawai->pegawai->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $masterPegawai->pegawai->nip }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan saat penilaian</th>
                            <td>{{ $masterPegawai->jabatan->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja saat penilaian</th>
                            <td>{{ $masterPegawai->jabatan->unit->nama }}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kompetensi</th>
                            <th>RCL</th>
                            <th>CCL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($result as $row)
                            <tr>
                                <td colspan="4">{{ $row['name'] }}</td>
                            </tr>
                            <?php $i=0;?>
                            @foreach($row['data'] as $data)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $data->title }} ({{ $data->code }})</td>
                                <td style="text-align: center;">{{ $data->rcl }}</td>
                                <td style="text-align: center;">{{ $data->ccl }}</td>
                            </tr>
                            @endforeach
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
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_pen").addClass("active");
        $("#menu_comp_pen_kem").addClass("active");
        $("#menu_comp_pen_kem_dir").addClass("active");
        $( "#help_app" ).tooltip();
    </script>
@stop
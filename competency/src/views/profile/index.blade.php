@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Profil Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk melihat profil kompetensi karyawan berdasar tipe kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>

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
                            <th>Jabatan</th>
                            <td>{{ $masterPegawai->jabatan->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td>{{ $masterPegawai->jabatan->unit->nama }}</td>
                        </tr>
                    </table>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $i=0; ?>
                        @foreach($data as $rowData)
                            <li @if($i == 0) class="active"@endif><a href="#type{{ $rowData['type']['id'] }}" role="tab" data-toggle="tab">{{ $rowData['type']['name'] }}</a></li>
                            <?php $i++;?>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content ">
                        <?php $i=0; ?>
                    @foreach($data as $rowData)

                            <div class="tab-pane @if($i == 0)active@endif" id="type{{ $rowData['type']['id'] }}">
                                <table class="table table-bordered table-striped table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Judul</th>
                                        {{--<th>RCL</th>--}}
                                        {{--<th>ITJ</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rowData['profile']) > 0)
                                    @foreach($rowData['profile'] as $rowProfile)
                                    <tr>
                                        <td>{{ $rowProfile->code }}</td>
                                        <td>{{ $rowProfile->title }}</td>
                                        {{--<td>{{ $rowProfile->rcl }}</td>--}}
                                        {{--<td>{{ $rowProfile->itj }}</td>--}}
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <?php $i++;?>

                    @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>

@stop

@section('customjs')
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_pro").addClass("active");
    </script>
@stop
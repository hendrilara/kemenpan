@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Pemantaoan Diklat
                <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk mengidentifikasi kebutuhan diklat"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#soft" role="tab" data-toggle="tab">Setujui Pendaftaran Diklat</a></li>
                    <li><a href="#hard" role="tab" data-toggle="tab">Catat Pelaksanaan Diklat</a></li>
                    <li><a href="#jash" role="tab" data-toggle="tab">Evaluasi Diklat</a></li>
                </ul>

                <!-- Tab panes -->

                <div class="tab-content">
                    <div class="tab-pane active" id="soft">
                        <button href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-primary">setujui</button>
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Kompetensi</th>
                                    <th>Nama Diklat</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Setujui Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta as $pes)
                                <tr>
                                    <td> {{$pes->nama_kompetensi}} </td>
                                    <td>{{$pes->judul_diklat}}</td>
                                    <td>{{$pes->jdwal_mulai}}</td>
                                    <td>{{$pes->jdwal_selesai}}</td>
                                    <td><a href="{{ url('admin/diklat/pemantaoan/setujui/'. $pes->id) }}"> Setujui</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="hard">
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="1">No</th>
                                    <th rowspan="1" style="text-align: center;">Nama Diklat</th>
                                    <th colspan="2" style="text-align: center;">Tanggal</th>
                                    <th colspan="2" style="text-align: center;">Anggaran</th>
                                    <th colspan="2" style="text-align: center;">Peserta</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Rencana</th>
                                    <th>Realisasi</th>
                                    <th>Anggaran</th>
                                    <th>Realisasi</th>
                                    <th>Rencana</th>
                                    <th>Realisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>kfkfk</td>
                                    <td>jkjk</td>
                                    <td><button href="" id="openBtn" data-toggle="modal" class="btn btn-primary"></button></td>
                                    <td><button href="" id="openBtn" data-toggle="modal" class="btn btn-primary">terisi</button></td>
                                    <td>fskfjksj</td>
                                    <td>fjsfjsfshf</td>
                                    <td>fajfshfjh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane" id="jash">
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Diklat</th>
                                    <th>Anggran</th>
                                    <th>A Penyapaian Materi</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><button href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-primary">setujui</button></td>
                                    <td>jkjk</td>
                                    <td><button href="" id="openBtn" data-toggle="modal" class="btn btn-primary"></button></td>
                                    <td><button href="" id="openBtn" data-toggle="modal" class="btn btn-primary">terisi</button></td>
                                    <td>fskfjksj</td>
                                    <td>fjsfjsfshf</td>
                                    <td>fajfshfjh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h3 class="modal-title">Evaluasi Program Diklat</h3>
                                </div>

                                <div class="modal-body">
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Judul Pelatihan</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Quata</th>
                                                    <td></td>
                                                </tr>
                                            </table>

                                            <table class="table table-bordered table-responsive table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nip</th>
                                                        <th>Nama</th>
                                                        <th>Jabatan</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Nilai Prioritas</th>
                                                        <th>Setujui</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- modal detail -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">simpan</button>
                                            <button type="button" class="btn btn-primary">Cetak</button>
                                        </div>
                                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="Mymodal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="myModal" aria-hidden="true">×</button>
                                                        <h3 class="modal-title">Evaluasi Program Diklat</h3>
                                                    </div>
                                                    <!-- modal evaluasi detail diklat -->
                                                    <div class="modal-body">
                                                        <div class="panel-body">
                                                            <div class="tab-content">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>Judul Pelatihan</th>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Tgl</th>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Quata</th>
                                                                        <td></td>
                                                                    </tr>
                                                                </table>

                                                                <table class="table table-bordered table-responsive table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Nip</th>
                                                                            <th>Nama</th>
                                                                            <th>Jabatan</th>
                                                                            <th>Unit Kerja</th>
                                                                            <th>Nilai Prioritas</th>
                                                                            <th>Setujui</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>

                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">simpan</button>
                                                                <button type="button" class="btn btn-primary">Cetak</button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    @stop

                                                    @section('customjs')
                                                    <script type="text/javascript">
                                                        $("#menu_diklat").addClass("active");
    $("#menu_pem").addClass("active");
                                                    </script>
                                                    @stop
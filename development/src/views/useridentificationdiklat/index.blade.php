@section('content')
<div class="row">
<div class="col-md-12">
    <section class="panel">
       <header class="panel-heading">
                    Identifikasi Kebutuhan Diklat
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk mengidentifikasi kebutuhan diklat"><i class="fa fa-question-circle"></i></a>
                </header>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#soft" role="tab" data-toggle="tab">Prioritas Pengembangan Kompetensi</a></li>
                <li><a href="#hard" role="tab" data-toggle="tab">Diklat Disarankan</a></li>

            </ul>
            <!-- Tab panes -->
        <div class="tab-content">
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
                </div>

            <div class="tab-content">
                <div class="tab-pane active" id="soft">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kompetensi</th>
                            <th>ITJ</th>
                            <th>RCL</th>
                            <th>CCL</th>
                            <th>GAP</th>
                            <th>Prioritas Pengembangan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($preoritask as $pre)
                              
                            <tr>
                                <td>no</td>
                                <td></td>
                                <td>{{ $pre->itj}}</td>
                                <td>{{ $pre->rcl }}</td>
                                <td>{{ $pre->ccl }}</td>
                                <td>{{ $pre->gap }}</td>
                                <td>P</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <?php echo $preoritask->links(); ?>;

                </div>

            <div class="tab-pane" id="hard">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kompetensi</th>
                            <th>Diklat Disarankan</th>
                            <th>TGL Pelaksanaan</th>
                            <th>Daftar</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>inti</td>
                            <td><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                              Judul Diklat
                             </button></td>
                            <td>tanggal dari admin</td>
                            <td><input type="checkbox"></td>
                        </tr>
                 </tbody>
                    </table>
              <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#rol" role="tab" data-toggle="tab">Agenda Diklat Saya</a></li>  
            </ul>
             <div class="contain">
            <div class="gantt"></div>
        </div>

                </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Achievement Motivation Development (AMD)</h4>
                      </div>
                      <div class="modal-body">
                        <p style="font-family: "Times New Roman", Georgia, Serif;">AMD merupakan pelatihan yang memfokuskan pada bagaimana mengembangkan motivasi kerja yang berorientasi pada peningkatan kinerja produktif. Motivasi dapat mendorong meningkatkan kompetensi sehingga model ini akan meningkatkan kinerja tinggi melalui kombinasi motivasi dan kompetensi individu. Pelatihan AMD bertujuan agar peserta dapat mengenali, meningkatkan dan menggunakan kualitas-kualitas positif berprestasi yang dimiliki, serta  dapat mengendalikan kualitas-kualitas negatif berprestasi sehingga dapat berdampak positif terhadap prestasi. Beberapa fokus bahasan dalam pelatihan AMD ini antara lain: Visi misi individu dan goal setting, Pengenalan diri: konsep diri dan locus of control, Motif sosial yang mempengaruhi perilaku individu, dan pengukuran serta pengembangan tingkat interaksi sosial, Analisis kekuatan dan kelemahan pribadi dan interaksi kelompok atau dengan orang lain, Achievement Syndrome</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

    </div>


        @stop

@section('customjs')
    <script type="text/javascript">
        $("#menu_dik").addClass("active");
        $("#menu_eva").addClass("active");
    </script>


@stop
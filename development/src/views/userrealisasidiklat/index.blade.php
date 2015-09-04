@section('content')
<div class="row">
<div class="col-md-12">
    <section class="panel">
       <header class="panel-heading">
             Realisasi Pelaksanaan Diklat
                 <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk realisasi pelaksanaan diklat">
                    <i class="fa fa-question-circle"></i></a>
                </header>

             <div class="panel-body">
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
                    </div>

            <div class="tab-content">
                <div class="tab-pane active id="soft"">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Jadwal Pelatihan</th>
                            <th>Tanggal</th>
                            <th>Konfirmasi Peserta</th>
                            <th>Evaluasi</th>
                        </tr>
                        </thead>
                        <tbody>
                              @foreach($page as $dik)
                           
                            <tr>
                                <td>{{ $dik->id_diklat_comp }}</td>
                                <td>jadwal</td>
                                <td>{{ $dik->jdwal_mulai }}</td>
                                <td></td>
                                <td><button href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-primary">Isi Evaluasi</button></td>
                                
                        </tbody>
                        @endforeach

                    </table> <?php echo $page->links(); ?>;

                </div>
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
                            <th>Nama Diklat</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Pihak Penyelesaian Diklat</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Jadwal Pelaksanaan</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Nama Peserta Diklat</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Nik</th>
                            <td></td>
                        </tr>
                    </table>
          <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th rowspan="2">no</th>
                        <th rowspan="2">Kriteria evaluasi</th>
                        <th colspan="5"><center>respon setuju dan tidak setuju</center></th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">A. Penyampaian Materi</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Tujuan diklat disampaikan dengan jelas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Topik yang dibahas relevan</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Setiap sesi Diklat menyampaikan sasaran dengan jelas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Terdapat kesempatan yang mencukupi bagi peserta untuk terlibat secara interaktif</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Materi diklat berguna bagi bidang pekerjaan saya</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Sebagian besar pertanyaan/permasalahan saya telah terjawab dalam Diklat ini</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Durasi Diklat mencukupi bagi penyelesaian seluruh bahasan materi</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Diklat dimulai dan diakhiri tepat waktu</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Diktat/bahan ajar Diklat sangat membantu saya dalam memahami</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td colspan="7">B. Nara Sumber</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Nara Sumber menguasai materi yang dibahas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nara Sumber mempersiapkan dengan baik tiap sesi diklat</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Nara Sumber mendorong terciptanya partisipasi aktif peserta</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nara Sumber menjawab pertanyaan dengan jelas dan lengkap</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Nara Sumber menghormati peserta</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td colspan="7">C. Fasilitas Diklat</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ruang kelas Diklat dan fasilitas penunjang lain di tata dengan baik sehingga menciptakan suasana pembelajaran yang nyaman</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                     <tr>
                        <td>2</td>
                        <td>Lokasi pelaksanaan Diklat membuat saya nyaman</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Makanan dan minuman yang disediakan berkualitas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Peralatan dan perlengkapan Diklat tidak berfungsi dengan baik</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td colspan="7">D. Kepuasan Secara Umum</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Tujuan Diklat telah tercapai dengan baik</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                     <tr>
                        <td>2</td>
                        <td>Saya merasa puas dengan peningkatan pengetahuan dan ketrampilan yang saya dapat dari Diklat ini</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                     <tr>
                        <td>3</td>
                        <td>Saya merekomendasikan Diklat yang sama diselenggarakan kembali bagi pegawai lain</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>

                    </tbody>
                </table>
          <div class="form-group">
            <input type="button" class="btn btn-warning btn-sm pull-right" value="Reset">
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
                
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>
        @stop

@section('customjs')
    <script type="text/javascript">
        $("#menu_dik").addClass("active");
        $("#menu_realisasi").addClass("active");
    </script>
@stop
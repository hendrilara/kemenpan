@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Perencanaan Diklat
                <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk mengidentifikasi kebutuhan diklat"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#soft" role="tab" data-toggle="tab">Jadwal Diklat</a></li>
                    <li><a href="#hard" role="tab" data-toggle="tab">Identifikasi Kebutuhan Diklat</a></li>
                    <li><a href="#jash" role="tab" data-toggle="tab">Susun Perencanaan Diklat</a></li>
                </ul>

                <!-- Tab panes -->

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
                                <!--<td>Kode</td>
                                <td>Nama Kopentensi</td>
                                <td>ITJ</td>
                                <td>RCL</td>
                                <td>CCL</td>
                                <td>GAP</td>
                                <td>Prioritas Pengembangan</td>-->

                            </tbody>
                        </table>

                    </div>
                    <!--identifikasi kebutuhan diklat-->
                    <div class="tab-pane" id="hard">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#inti" role="tab" data-toggle="tab">inti dan manajerial</a></li>
                            <li><a href="#fung" role="tab" data-toggle="tab">fungsional</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="inti">
                                <br><br>
                                {{Form::open(array('url' => 'admin/diklat/perencanaan', 'method'=>'post')) }}
                                <div class="form-group col-lg-6">
                                    <select id="intl" class="form-control select" name="unitt" >
                                        <option value="">Pilih Unit Kerja</option>
                                        <option value="RBKUNWAS">DEPUTI BIDANG REFORMASI BIROKRASI, AKUNTBILITAS APARATUR, DAN PENGAWASAN</option>
                                        <option value="KLTL">DEPUTI BIDANG KELEMBAGAAN DAN TATA LAKSANA</option>
                                        <option value="SDM">Deputi SUMBER DAYA MANUSIA APARATUR</option>
                                        <option value="YANLIK">DEPUTI SUMBER DAYA MANUSIA PELAYANAN PUBLIK</option>
                                        <option value="SESMEN">SEKRETARIAT KEMENTERIAN PAN DAN RB</option>
                                        <option value="INSPEKTORAT">INSPEKTORAT</option>
                                        <option value="STAF AHLI">STAF AHLI</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button id="submit" type="submit" class="btn btn-primary" name="submit">Cari</button>
                                </div>
                                {{Form::close()}}
                                <br><br>
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jumlah karyawan</th>
                                            <th>Daftar Kompetensi</th>
                                            <th>Nama Kompetensi</th>
                                            <th>Judul Pelatihan</th>
                                            <th>ITJ</th>
                                            <th>RCL</th>
                                            <th>CCL</th>
                                            <th>GAP</th>
                                            <th>Prioritas Pengembangan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(isset($deputti))
                                        @foreach($deputti as $deputtt)
                                        @if($deputtt->type_id=='1')
                                        <?php
                                        $has = $deputtt->gap * $deputtt->itj;
                                        $cil = count($deputtt->gap);
                                        ?>
                                        <tr>
                                            <td> {{ $cil }} </td>
                                            <td> {{$deputtt->name}} </td>
                                            <td> {{$deputtt->title}} </td>
                                            <td></td>
                                            <td> {{$deputtt->itj}} </td>
                                            <td> {{$deputtt->rcl}} </td>
                                            <td> {{$deputtt->ccl}} </td>
                                            <td> {{$deputtt->gap}} </td>
                                            <td> {{$has}} </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                                <?php
                                if (isset($deputti)):echo $deputti->links();
                                endif;
                                ?>
                            </div>
                            <div class="tab-pane" id="fung">
                                <br><br>
                                {{Form::open(array('url' => 'admin/diklat/perencanaan',  'method'=>'post')) }}
                                <div class="form-group col-lg-6">
                                    <select id="fungi" class="form-control select" name="unit" >
                                        <option value="">Pilih Unit Kerja</option>
                                        <option value="RBKUNWAS">DEPUTI BIDANG REFORMASI BIROKRASI, AKUNTBILITAS APARATUR, DAN PENGAWASAN</option>
                                        <option value="KLTL">DEPUTI BIDANG KELEMBAGAAN DAN TATA LAKSANA</option>
                                        <option value="SDM">Deputi SUMBER DAYA MANUSIA APARATUR</option>
                                        <option value="YANLIK">DEPUTI SUMBER DAYA MANUSIA PELAYANAN PUBLIK</option>
                                        <option value="SESMEN">SEKRETARIAT KEMENTERIAN PAN DAN RB</option>
                                        <option value="INSPEKTORAT">INSPEKTORAT</option>
                                        <option value="STAF AHLI">STAF AHLI</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                                {{Form::close()}}
                                <br><br>
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jumlah karyawan</th>
                                            <th>Daftar Kompetensi</th>
                                            <th>Nama Kompetensi</th>
                                            <th>Judul Pelatihan</th>
                                            <th>ITJ</th>
                                            <th>RCL</th>
                                            <th>CCL</th>
                                            <th>GAP</th>
                                            <th>Prioritas Pengembangan</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(isset($deputi))
                                        @foreach($deputi as $deputt)
                                        @if($deputt->type_id=='2')
                                        <?php
                                        $hasil = $deputt->gap * $deputt->itj;
                                        $cicil = count($deputt->gap);
                                        ?>
                                        <tr>
                                            <td> {{ $cicil }} </td>
                                            <td> {{$deputt->name}} </td>
                                            <td> {{$deputt->title}} </td>
                                            <td></td>
                                            <td> {{$deputt->itj}} </td>
                                            <td> {{$deputt->rcl}} </td>
                                            <td> {{$deputt->ccl}} </td>
                                            <td> {{$deputt->gap}} </td>
                                            <td> {{$hasil}} </td>

                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                                <?php
                                if (isset($deputi)):echo $deputi->links();
                                endif;
                                ?>
                            </div>
                        </div>


                        <br>


                    </div>
 <!-- dialog input tambah diklat -->
                <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModal">Tambah Diklat</h4>
                            </div>
                            <div class="modal-body">
                                {{ Form::open(array('url' => 'admin/diklat/diklat/proses','method'=>'post' )) }}
                                <input id="ta" name="ta" type="hidden" />
                                <div class="form-group">
                                    <font color="red">*</font>
                                    <label for="message-text" class="control-label">Kompetensi:</label> 
                                    <select id="autocompleted" class="form-control select" name="kompetensi">
                                        <option value="0">Pilih Kompetensi</option>
                                        @foreach($kompetensi as $komp)
                                        <option  value="{{$komp->id}}"> {{$komp->name}}</option>
                                        @endforeach
                                    </select>
                                    {{ $errors->first('ta') }}
                                </div> 

                                <div class="from-group">
                                    <font color="red">*</font><label for="message-text" class="control-label" name="kompetensi">Nama Kompetensi:</label>
                                    <select id="mboh" class="form-control select">
                                        <option value="0">Pilih Kompetensi</option>
                                    </select>
                                </div>

                                <div class="from-group">
                                   <font color="red">*</font> <label for="message-text" class="control-label">Judul Diklat:</label>
                                    <select id="diklat" class="form-control select">
                                        <option value="0">Pilih Judul Diklat</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                   <font color="red">*</font> <label for="message-text" class="control-label">Deskripsi:</label>
                                    <textarea class="form-control" readonly name="deskripsi" id="deskripsi"></textarea>
                                    {{$errors->first('deskripsi')}}
                                </div>

                                <div class="form-group">
                                  <font color="red">*</font>  <label for="message-text" class="control-label">Sasaran/Tujuan:</label>
                                    <input type="text" class="form-control" name="sasaran" id="#">
                                    {{$errors->first('sasaran')}}
                                </div>

                                <div class="form-group">
                                   <font color="red">*</font> <label for="message-text" class="control-label">Tanggal Mulai Pelaksanaan:</label>
                                    <input id="datepicker" type="text" name="tglmulai" class="form-control" >
                                  {{$errors->first('tglmulai')}}
                                </div>

                                <div class="form-group">
                                   <font color="red">*</font> <label for="message-text" class="control-label">Tanggal Selesai Pelaksanaan:</label>
                                    <input id="tanggalanen" type="text" name="tglselesai" class="form-control" >
                                   {{$errors->first('tglselesai')}}
                                </div>

                                <div class="form-group">
                                   <font color="red">*</font> <label for="message-text" class="control-label">Jumlah Hari Diklat:</label>
                                    <input type="text" name="jmlhari" class="form-control" >
                                    {{$errors->first('jmlhari')}}
                                </div>

                                <div class="form-group">
                                 <font color="red">*</font>   <label for="message-text" class="control-label">Kuota Peserta:</label>
                                    <input type="text" name="kuota" class="form-control" id="#">
                                    {{$errors->first('kuota')}}
                                </div>

                                <div class="from-group">
                                 <font color="red">*</font>   <label for="message-text" class="control-label">Anggaran Diklat:</label>
                                    RP. <input type="text" name="anggaran" class="form-control" id="#">
                                    {{$errors->first('anggaran')}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary submit">simpan</button>
                                <button type="button" class="btn btn-primary">Cetak</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                    <div class="tab-pane" id="jash">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#intimanajerial" role="tab" data-toggle="tab">inti dan manajerial</a></li>
                            <li><a href="#fungsional" role="tab" data-toggle="tab">fungsional</a></li>
                        </ul>
                        <div class="tab-content">
                            <br>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-primary btn-small" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-plus"></i>Tambah</a>
                                </button>
                            </div>
                            <div class="col-lg-8">
                               @if(Session::has('message')):<div class="alert alert-warning alert-dismissible" role="alert">{{ Session::get('message') }}</div>@endif
                            </div>
                            <div class="tab-pane active" id="intimanajerial">
                                <br><br>
                                {{Form::open(array('url' => 'admin/diklat/perencanaan',  'method'=>'post')) }}
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kompetensi</th>
                                            <th>Judul Diklat</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($agendaf as $agen)
                                        @if($agen->id_competency=='1')
                                        <tr>
                                            <td> {{$agen->id }} </td>
                                            <td>{{$agen->name}} </td>
                                            <td> {{$agen->nama_kompetensi}} </td>
                                            <td> {{$agen->jdwal_mulai}} </td>
                                            <td> {{$agen->jdwal_selesai}} </td>
                                            <td> <a href="{{ url('admin/diklat/diklat/preview/'. $agen->id) }}"> Preview </a>| <a href="{{ url('admin/diklat/diklat/hapus/'. $agen->id) }}" onClick="return confirm('Apakah anda akan menghapus data ini?');">Hapus Kandidat</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $agendaf->links(); ?>
                            </div>
                            <div class="tab-pane" id="fungsional">
                                <br><br>
                                {{Form::open(array('url' => 'admin/diklat/perencanaan',  'method'=>'post')) }}
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kompetensi</th>
                                            <th>Judul Diklat</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($agenda as $agen)
                                        @if($agen->id_competency=='2')
                                        <tr>
                                            <td> {{$agen->id }} </td>
                                            <td>{{$agen->name}} </td>
                                            <td> {{$agen->nama_kompetensi}} </td>
                                            <td> {{$agen->jdwal_mulai}} </td>
                                            <td> {{$agen->jdwal_selesai}} </td>
                                            <td> <a href="{{ url('admin/diklat/diklat/preview/'. $agen->id) }}"> Preview </a>| <a href="{{ url('admin/diklat/diklat/hapus/'. $agen->id) }}" onClick="return confirm('Apakah anda akan menghapus data ini?');">Hapus Kandidat</a></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <?php echo $agenda->links(); ?>
                            </div>
                            <br>
                        </div>
                        <br>
                    </div>
                    
                </div>
               
            </div>
    </div>
</div>
@stop
@section('customcss')
<link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>

<style type="text/css">
    .modal .modal-content {
        max-height: 800px;
        overflow-y: scroll;
    }

    .datepicker{
        margin-left: 100px;
        z-index: 100000;
    }
</style>
@stop
@section('customjs')
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">

                                                $('#datepicker').datepicker({
                                                    format: 'yyyy-mm-dd',
                                                    startDate: '-3d'
                                                })
                                                $('#tanggalanen').datepicker({
                                                    format: 'yyyy-mm-dd',
                                                    startDate: '-3d'
                                                })

</script>

<script type="text/javascript">
    $("#menu_eva").addClass("active");
    $("#mboh").select2();
    $("#autocompleted").select2();
    $("#diklat").select2();



$(document).ready(function () {
    $('#autocompleted').change(function () {
        var dataId = $('#autocompleted').val();
        $.ajax({
            url: "{{ url('admin/diklat/diklat/rencana') }}/" + dataId,
            success: function (data) {
                $.each(data, function (i, n) {
                    //console.log(n);
                    $("#mboh").append("<option>" + n.nama_kompetensi + "</option>");
                });
            }
        });
    });
    });
    //});

    $(document).ready(function () {
        $("#mboh").change(function () {
            var dataId = $("#mboh").val();
            var dataKom = $("#autocompleted").val();
            $.ajax({
                url: "{{ url('admin/diklat/diklat/kompetensi') }}/" + dataId + "/" + dataKom,
                success: function (data) {
                    //console.log(data);
                    //$("#mboh").val(myObject.id_competency);
                    //$("#mboh").val(data);
                    $.each(data, function (i, n) {
                        $("#diklat").append("<option>" + n.judul_diklat + "</option>");

                        //console.log(n);
                    });
                }
            });
        });
        $('#mboh').trigger('change');
    });

    $(document).ready(function () {
        $('#diklat').change(function () {
            var dataId = $('#diklat').val();
            $.ajax({
                url: "{{ url('admin/diklat/diklat/diklat') }}/" + dataId,
                success: function (data) {
                    //console.log(data);
                    $.each(data, function (i, m) {
                        $("#deskripsi").html(m.deskripsi);
                        $("#ta").val(m.id_comp);
                        //$("#iddiklat").val(m.iddiklat);
                    });
                }
            });
        });
        $('diklat').trigger('change');
    });

</script>
<script type = "text/javascript">
    $("#menu_diklat").addClass("active");
    $("#menu_dik").addClass("active");
    
    $('ul.nav-tabs li a').click(function (e) {
  $('ul.nav nav-tabs li.active').removeClass('active')
  $(this).parent('.hard').addClass('active')
  
})
    
    $('.select').on("change", function (e) {
        //            var selectId = $(this).val();
        $('#orderForm').submit();
        e.preventDefault();
    });
</script>
@stop
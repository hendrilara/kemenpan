@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Perencanaan Diklat
                <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk mengidentifikasi kebutuhan diklat"><i class="fa fa-question-circle"></i></a>
            </header>
           
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
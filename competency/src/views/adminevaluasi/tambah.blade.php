@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Tambah Diklat
                <a href="javascript:void(0)" id="help_app" title="Menu Ini Menambahkan Prasyarat Pada Eselon Jabatan"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">

                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
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
                            <div class="panel-footer clearfix">
                                <div class="pull-right">
                                <button type="submit" class="btn btn-primary submit">simpan</button>
                                <button type="button" class="btn btn-primary">Cetak</button>
                            </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </section>
                </div>
            </div>
        </section>
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
startDate: '-3d'
})
$('#tanggalanen').datepicker({
startDate: '-3d'
})

</script>

<script type="text/javascript">
    $("#menu_eva").addClass("active");
    $("#mboh").select2();
    $("#autocompleted").select2();
    $("#diklat").select2();

    $('.select').on("change", function (e) {
//            var selectId = $(this).val();
        $('#orderForm').submit();
        e.preventDefault();
    });

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
    });

</script>
<script type = "text/javascript">
    $("#menu_diklat").addClass("active");
    $("#menu_dik").addClass("active");
    $('.select').on("change", function (e) {
        //            var selectId = $(this).val();
        $('#orderForm').submit();
        e.preventDefault();
    });
</script>

@stop
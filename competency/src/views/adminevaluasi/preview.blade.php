@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Preview Agenda Diklat
                <a href="javascript:void(0)" id="help_app" title="Halaman ini Digunakan Untuk Melihat Preview Daftar Agenda Diklat"><i class="fa fa-question-circle"></i></a>
            </header>

            <div class="panel-body">
                <table class="table table-bordered table-striped table-advance table-hover">
                    <tbody>
                        <tr>
                            <th>Daftar Kompetensi</th>
                            <td>@if($preview->id_competency=='1') {{"Inti dan Manajerial"}} @else {{"Fungsional"}} @endif</td>

                        </tr>
                        <tr>
                            <th>Nama Kompetensi</th>
                            <td>{{ $preview->nama_kompetensi }}</td>
                        </tr>
                        <tr>
                            <th>Judul Diklat</th>
                            <td>{{ $preview->judul_diklat }}</td>
                        </tr>
                        <tr>
                            <th>Sasaran</th>
                            <td>{{ $preview->sasaran }}</td>
                        </tr>
                        <tr>
                            <th>Kuota</th>
                            <td>{{ $preview->kuota }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Hari Pelaksanaan</th>

                            <td>{{ $preview->jmlhari }}</td>
                        </tr>
                        <tr>
                            <th>Jadwal Pelaksanaan</th>

                            <td>{{ $preview->jdwal_mulai }}</td>
                        </tr>
                        <tr>
                            <th>Jadwal Selesai Pelaksanaan</th>

                            <td>{{ $preview->jdwal_selesai }}</td>
                        </tr>
                        <tr>
                            <th>Anggaran</th>

                            <td>{{ "Rp"."  ".$preview->anggaran }}</td>
                        </tr>
                    </tbody>
                </table>
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
<script type="text/javascript">
$("#menu_diklat").addClass("active");
$("#menu_dik").addClass("active");
$("#help_app").tooltip();
</script>

@stop
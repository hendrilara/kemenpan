@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Perencanaan Diklat
                <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk mengidentifikasi kebutuhan diklat"><i class="fa fa-question-circle"></i></a>
            </header>


            <div class="panel-body">
                <div class="tab-content">
                    <table class="table table-bordered">
                        <tr>
                            <th>Judul Pelatihan</th>
                            <td> {{$pelatihan->judul_diklat}} </td>
                        </tr>
                        <tr>
                            <th>Tgl</th>
                            <td>{{$pelatihan->mulai}}</td>
                        </tr>
                        <tr>
                            <th>Kuata</th>
                            <td> {{$pelatihan->kuota}} </td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>Nip</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>Nilai Prioritas</th>
                                <th>Status</th>
                                <th>Setujui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemantauan as $pantau)
                            <tr>
                                <td>{{$pantau->nip}}</td>
                                <td>{{$pantau->nama}}</td>
                                <td>{{$pantau->nama_lengkap}}</td>
                                <td>{{$pantau->unit}}</td>
                                <td>{{$pantau->nip}}</td>
                                <td>@if(empty($pantau->setuju)) {{"Belum DI setujui"}}@else {{$pantau->setuju}} @endif </td>
                                <td><button href="#myModal"  data-whatever="{{$pantau->id}}" id="dialogo openBtn" data-toggle="modal" class="btn btn-primary" value="" >setujui</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Setujui Agenda Diklat</h3>
            </div>

            <div class="modal-body">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="control-group">
                            <label class="control-label"><h5><b>Status Diklat:</b></h5></label>
                            {{ Form::open(array('url' => 'admin/diklat/pemantaoan/setujui/proses','method'=>'post' )) }}
                            <br>
                            <input type="radio" name="setujui" value="setujui" aria-label="..." active>Setujui  | <input type="radio" name="setujui" value="belum" aria-label="...">Belum
                            <input type="hidden" name="tex" class="tex">
                        </div>
                    </div>
                    <!-- modal detail -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="Submit" name="submit" class="btn btn-primary">simpan</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('customjs')
<script type="text/javascript">
    $("#menu").addClass("active");
</script>
<script type = "text/javascript">
    $("#menu_diklat").addClass("active");
    $("#menu_pem").addClass("active");
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever');
        console.log(recipient);
        var modal = $(this)
        modal.find('.modal-body .tex').val(recipient)
    })
</script>
@stop
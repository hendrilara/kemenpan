@section('customcss')
    <link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Ubah data Kolega, kustomer, atasan dan bawahan
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah merubah dan menghapus daftar kamus kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <tr>
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
                            <td>{{ $masterPegawai->jabatan->unit->nama or "-" }}</td>
                        </tr>
                        </tr>
                    </table>
                </div>
                <div class="panel-body">
                    @if (\Illuminate\Support\Facades\Session::has('message'))
                        <div class="alert alert-success fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            {{ \Illuminate\Support\Facades\Session::get('message') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>Nip</th>
                            <th>Nama</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($peers as $row)
                            <tr>
                                <td>{{ $row->user_id }}</td>
                                <td>{{ $row->rater->nama }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle" data-original-title="" title="">
                                            Aksi
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a class="updatePeers" data-id="{{ $row->id }}" ><i class="fa fa-edit"></i> Ubah Kolega</a>
                                            </li>
                                            <li>
                                                <a class="deleteData" data-id="{{ $row->id }}"><i class="fa fa-times"></i> Hapus Data Kolega</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update</h4>
                </div>
                {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Pegawai</label>
                        <div class="col-lg-10">
                            <select id="autocomplete" class="form-control select" name="parent">
                                <option value="all" @if((Input::has('parent')) && (Input::get('parent') == 'all')) selected @endif >semua kompetensi </option>
                                <option value="0" @if((Input::has('parent')) && (Input::get('parent') == '0')) selected @endif> hanya kompetensi kepala </option>
                                @foreach($pegawai as $rowPegawai)
                                    <option value="{{ $rowPegawai->nip }}" >{{ $rowPegawai->nama }} ({{ $rowPegawai->nip }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Jabatan</label>
                        <div class="col-lg-10">
                            <p class="form-control-static" id="peers_jabatan">--</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Unit Kerja</label>
                        <div class="col-lg-10">
                            <p class="form-control-static" id="peers_unit">--</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Status</label>
                        <div class="col-lg-10">
                            <select id="peers_status" class="form-control" name="status">
                                <option value="0">pilih salah satu status</option>
                                <option value="kolega">Kolega</option>
                                <option value="customer">Kostumer</option>
                                <option value="atasan">Atasan</option>
                                <option value="bawahan">Bawahan</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_dic").addClass("active");
        $( "#help_app" ).tooltip();

        $(".updatePeers").on("click", function(e){
            var peersId = $(this).data("id");
            $.get("{{ url('api/competency/peers/detail') }}/"+peersId, function(data){
                console.log(data.rater.jabatanpengukuran);
                jabatan = data.rater.jabatanpengukuran['0'];
                console.log(jabatan);
                $("#peers_jabatan").html(jabatan.nama_lengkap);
                $("#peers_unit").html(jabatan.unit.nama);
                $("#peers_status").val(data.status);
                $('#myModal').modal();
            });
        });
        $("#autocomplete").select2();
        $(".deleteData").on("click", function(e){
            var dataId = $(this).data("id");
            bootbox.confirm("Lanjutkan menghapus data kolega?", function(result) {
                if (result) {
                    window.location = "{{ url('admin/competency/peers/delete') }}/"+dataId;
                }
            });
            e.preventDefault();
        });
        $('.select').on("change", function(e){
//            var selectId = $(this).val();
            $('#orderForm').submit();
            e.preventDefault();
        });

    </script>

@stop
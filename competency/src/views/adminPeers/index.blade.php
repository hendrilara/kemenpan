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
                    Daftar Kolega, Atasan dan Bawahan
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah merubah dan menghapus daftar kamus kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="orderForm" class="form-inline pull-right" role="form" action="{{ Request::url('admin/competency/peers') }}" method="get">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="pencarian" name="keyword" value="@if(Input::has('keyword')){{ Input::get('keyword') }}@endif">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                            <th>Jabatan saat Pengukuran</th>
                            <th>Jumlah Kolega</th>
                            <th>Jumlah Customer</th>
                            <th>Jumlah Bawahan</th>
                            <th>Jumlah Atasan</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pegawai as $data)
                            <tr>
                                <td> {{ $data->nip }} </td>
                                <td> {{ $data->nama }} </td>
                                <td> {{ $data->nama_lengkap }}</td>
                                <td style="text-align: center;"> {{ count(\Meniqa\Competency\Models\CompetencyPeers::getPeersByStatus($competencyActive->id, $data->nip, 'kolega')) }}</td>
                                <td style="text-align: center;"> {{ count(\Meniqa\Competency\Models\CompetencyPeers::getPeersByStatus($competencyActive->id, $data->nip, 'customer')) }}</td>
                                <td style="text-align: center;"> {{ count(\Meniqa\Competency\Models\CompetencyPeers::getPeersByStatus($competencyActive->id, $data->nip, 'bawahan')) }} </td>
                                <td style="text-align: center;"> {{ count(\Meniqa\Competency\Models\CompetencyPeers::getPeersByStatus($competencyActive->id, $data->nip, 'atasan')) }} </td>
                                <td>
                                    <a href="{{ url('admin/competency/peers/detail/'.$data->nip) }}" class="btn btn-success btn-sm"><i class="fa fa-folder-open-o"></i> Lihat detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>


    {{ $pegawai->links('layouts.backend.pagination')}}
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_dic").addClass("active");
        $( "#help_app" ).tooltip();

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
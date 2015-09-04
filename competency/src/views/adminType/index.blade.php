@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Daftar tipe kompetensi
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah merubah dan menghapus daftar tipe kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ url('admin/competency/type/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
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
                            <th>Nama</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listData as $data)
                            <tr>
                                <td> {{ $data->name }} </td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle" data-original-title="" title="">
                                            Aksi
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ url('admin/competency/type/update/'.$data->id) }}" ><i class="fa fa-edit"></i> Ubah Data</a>
                                            </li>
                                            <li>
                                                <a class="deleteData" data-id="{{ $data->id }}"><i class="fa fa-times"></i> Hapus Data</a>
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


    {{ $listData->links('layouts.backend.pagination')}}
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script type="text/javascript">
    $("#menu_comp").addClass("active");
    $("#menu_comp_typ").addClass("active");
    $( "#help_app" ).tooltip();

    $(".deleteData").on("click", function(e){
        var dataId = $(this).data("id");
        bootbox.confirm("Menghapus Tipe Kompetensi akan menyebabkan kamus di bawah tipe hilang. lanjutkan menghapus data?", function(result) {
            if (result) {
                window.location = "{{ url('admin/competency/type/delete') }}/"+dataId;
            }
        });
        e.preventDefault();
    });
</script>
@stop
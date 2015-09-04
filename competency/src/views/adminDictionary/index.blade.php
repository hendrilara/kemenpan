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
                    Daftar Kamus Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah merubah dan menghapus daftar kamus kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="orderForm" class="form-inline" role="form" action="{{ Request::url() }}" method="post">
                                <a href="{{ url('admin/competency/dictionary/create') }}" class="btn btn-success col-lg-2"><i class="fa fa-plus"></i> Tambah Data</a>
                                <div class="form-group col-lg-6">
                                    <select id="autocomplete" class="form-control select" name="parent">
                                        <option value="all" @if((Input::has('parent')) && (Input::get('parent') == 'all')) selected @endif >semua kompetensi </option>
                                        <option value="0" @if((Input::has('parent')) && (Input::get('parent') == '0')) selected @endif> hanya kompetensi kepala </option>
                                        @foreach($listDataParent as $dataParent)
                                            <option value="{{ $dataParent->id }}" @if((Input::has('parent')) && (Input::get('parent') == $dataParent->id)) selected @endif>{{ $dataParent->code }} ({{ $dataParent->title }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <select class="form-control select" name="type">
                                        <option value="all">Semua Tipe Kompetensi</option>
                                        @foreach($listDataType as $dataType)
                                            <option value="{{ $dataType->id }}" @if((Input::has('type')) && (Input::get('type')) == $dataType->id) selected @endif>{{ $dataType->name }}</option>
                                        @endforeach
                                    </select>
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
                            <th>Tipe</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Kompetensi Kepala</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listData as $data)
                            <tr>
                                <td> {{ $data->competencyType->name }} </td>
                                <td> {{ $data->code }} </td>
                                <td> {{ $data->title }} </td>
                                <td> @if($data->parent == 0) -- @else {{ $data->kepala->code }} @endif </td>
                                <td>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle" data-original-title="" title="">
                                            Aksi
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{{ url('admin/competency/level/dictionary/'.$data->id) }}" ><i class="fa fa-edit"></i> Ubah Level</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/competency/dictionary/update/'.$data->id) }}" ><i class="fa fa-edit"></i> Ubah Deskripsi</a>
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
            bootbox.confirm("Lanjutkan menghapus data?", function(result) {
                if (result) {
                    window.location = "{{ url('admin/competency/dictionary/delete') }}/"+dataId;
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
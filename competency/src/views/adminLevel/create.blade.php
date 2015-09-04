@section('customcss')

@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ $dataDictionary->code }} - {{ $dataDictionary->title }}
                </header>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <tbody>
                        <tr>
                            <th>Tipe</th>
                            <td>{{ $dataDictionary->type_id }}</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>{{ $dataDictionary->code }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $dataDictionary->title }}</td>
                        </tr>
                        <tr>
                            <th>Kepala</th>
                            <td>@if (count($dataDictionary->kepala) > 0) {{ $dataDictionary->kepala->code }} - {{ $dataDictionary->kepala->title }} @endif</td>
                        </tr>
                        <tr>
                            <th>Deksripsi</th>
                            <td>{{ $dataDictionary->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tambah Data Level
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ url('admin/competency/level/create/'.$dataDictionary->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($dataLevel) > 0)
                            @foreach($dataLevel as $level)
                                <tr>
                                    <td>{{ $level->title }}</td>
                                    <td>{{ $level->value }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle" data-original-title="" title="">
                                                Aksi
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ url('admin/competency/dictionary/edit/'.$level->id) }}" ><i class="fa fa-edit"></i> Ubah Data</a>
                                                </li>
                                                <li>
                                                    <a class="deleteData" data-id="{{ $level->id }}"><i class="fa fa-times"></i> Hapus Data</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript">
        $(".deleteData").on("click", function(e){
            var dataId = $(this).data("id");
            bootbox.confirm("Lanjutkan menghapus data?", function(result) {
                if (result) {
                    window.location = "{{ url('admin/competency/level/delete') }}/"+dataId;
                }
            });
            e.preventDefault();
        });
    </script>
@stop
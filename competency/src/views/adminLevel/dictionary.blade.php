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
                    Leveling
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a data-toggle="modal" data-id="{{ $dataDictionary->id }}" href="#modalCreate" class="btn btn-success" id="createData"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                </div>
                @if (\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ \Illuminate\Support\Facades\Session::get('message') }}
                    </div>
                @endif
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
                                                <a href="#modalCreate" data-levelid="{{ $level->id }}" class="updateData"><i class="fa fa-edit"></i> Ubah Data</a>
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
                <!-- Modal -->
                <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            {{ Form::open(array('url' => url('admin/competency/level/dictionary/create/'.$dataDictionary->id), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Level</h4>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" name="dictionary_id" value="{{ $dataDictionary->id }}" id="dictionaryId">

                                <div class="form-group @if ($errors->has('title')) has-error @endif">
                                    <label class="control-label col-md-2">Nama</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="levelName" placeholder="Nama level" name="title">
                                        @if ($errors->has('title'))<span class="help-block">{{ $errors->first('title') }}.</span>@endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('description')) has-error @endif">
                                    <label class="control-label col-md-2">Deskripsi</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control ckeditor" id="levelDescription" name="deskripsi" rows="6"></textarea>
                                        @if ($errors->has('description'))<span class="help-block">{{ $errors->first('description') }}.</span>@endif
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('value')) has-error @endif">
                                    <label class="control-label col-md-2">Nilai level</label>
                                    <div class="col-md-10">
                                        <select name="value" class="form-control" id="levelValue">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        @if ($errors->has('level'))<span class="help-block">{{ $errors->first('level') }}.</span>@endif
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                                <button class="btn btn-warning" type="button" id="saveButton"> Simpan</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </section>
        </div>
    </div>
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript">
        $("#modalCreate").modal({show : false});

        $("#createData").on("click", function(e){
            $("#levelId").remove();
            $("#modalCreate").modal('show');
            e.preventDefault();
        });

        $(".deleteData").on("click", function(e){
            var dataId = $(this).data("id");
            bootbox.confirm({
                title: "Hapus Data",
                message: "Lanjutkan menghapus data?",
                callback: function(result) {
                    if (result) {
                        window.location = "{{ url('admin/competency/level/delete') }}/"+dataId;
                    }
                }
            });
            {{--bootbox.confirm("Lanjutkan menghapus data?", function(result) {--}}
                {{--if (result) {--}}
                    {{--window.location = "{{ url('admin/competency/level/delete') }}/"+dataId;--}}
                {{--}--}}
            {{--});--}}
            e.preventDefault();
        });

        $(".updateData").on("click", function(e){
            var levelId = $(this).data('levelid');
            $.get("{{ url('admin/competency/level/jsondetail') }}/"+levelId, function(data){
                $("#levelName").val(data.title);
                $("#levelDescription").val(data.description);
                $("#levelValue").val(data.value);

                $("#dictionaryId").after('<input type="hidden" name="level_id" value=""+levelId+"" id="levelId">')

                $("#modalCreate").modal("show");
            });
            e.preventDefault();
        });
        
         $('#myModal').on('shown', function () {
    //your code to display the message
 })
    </script>
@stop
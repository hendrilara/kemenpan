@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                {{ Form::open(array('url' => Request::url(), 'class' => 'form-horizontal', 'role' => 'form', 'method'=>'post')) }}
                <div class="form-group">
                    <label for="code" class="col-lg-2 col-sm-2 control-label">Jadwal Kompetensi</label>
                    <div class="col-lg-10">
                        <select name="competency" class="form-control">
                            @foreach($competencies as $competency)
                            <option value="{{ $competency->id }}" @if((Input::has('competency')) && (Input::get('competency') == $competency->id)) selected="selected" @endif> {{ $competency->year }} ({{ $competency->date_start }} s/d {{ $competency->date_end }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="code" class="col-lg-2 col-sm-2 control-label">Jenis Kompetensi</label>
                    <div class="col-lg-10">
                        <select name="type" class="form-control">
                            @foreach($competencyTypes as $type)
                            <option value="{{ $type->id }}" @if((Input::has('type')) && (Input::get('type') == $type->id)) selected="selected" @endif > {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-danger">simpan</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </section>

        @if(!is_null($profile))
        <section class="panel">
            <header class="panel-heading">
                Profil Kompetensi
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kompetensi</th>
                            <th>RCL</th>
                            <th>ITJ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($profile) > 0)
                        @foreach($profile as $row)
                        <tr>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->rcl }}</td>
                            <td>{{ $row->itj }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4">Data tidak ditemukan dalam database. harap menghubungi admin</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
        @endif
    </div>
</div>
@stop
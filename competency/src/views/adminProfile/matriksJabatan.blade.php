@section('customcss')
    <link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Matriks Jabatan Kompetensi tahun {{ $dataScheduleActive->year }}
                </header>
                <div class="panel-body">
                    {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'get')) }}
                    <div class="form-group @if ($errors->has('q1')) has-error @endif">
                        <label class="control-label col-md-2">Tipe Kompetensi</label>
                        <div class="col-md-10">
                            <select class="form-control autocomplete select" name="q1">
                                @foreach($dataJabatan as $jabatan)
                                    <option value="{{ $jabatan->unit_staf_id }}" @if((Input::has('q1')) && (Input::get('q1') == $jabatan->unit_staf_id)) selected @endif>{{ $jabatan->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('q1'))<span class="help-block">{{ $errors->first('q1') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-danger">Pilih</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                {{--<div class="panel-body">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-12">--}}
                            {{--<a href="{{ url('admin/competency/profile/downloadmatriksjabatan'.Input::get('q1')) }}" class="btn btn-success"><i class="fa fa-share-square-o"></i> Unduh profil </a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="panel-body">
                    @if(!is_null($dataProfile))
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tipe Kompetensi</th>
                                <th>Kode Kompetensi</th>
                                <th>Nama Kompetensi</th>
                                <th>RCL</th>
                                <th>ITJ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataProfile as $profile)
                                <tr>
                                    <td>{{ $profile->competencyDictionary->competencyType->name }}</td>
                                    <td>{{ $profile->competencyDictionary->code }}</td>
                                    <td>{{ $profile->competencyDictionary->title }}</td>
                                    <td>{{ $profile->rcl }}</td>
                                    <td>{{ $profile->itj }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @endif
                </div>
            </section>
        </div>
    </div>
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript">
        $(".autocomplete").select2();
    </script>

@stop
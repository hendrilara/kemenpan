@section('customcss')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/select2-bootstrap.css') }}">
@stop

@section('content')
<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            Advanced File Input
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
            </span>
        </header>
        <div class="panel-body">
            {{ Form::open(array('url' => Request::url(), 'class' =>
            'form-horizontal tasi-form', 'method' => 'post')) }}
            <div class="form-group @if ($errors->has('unit')) has-error @endif">
                <label class="control-label col-md-3">Unit</label>
                <div class="col-md-3 col-xs-11">
                    <select class="form-control select-2" name="unit">
                        <option value="0">-- Pilih Salah Satu --</option>
                        @foreach($units as $rowUnit)
                        <option value="{{ $rowUnit->unit_staf_id }}" @if($unit->unit_staf_id == $rowUnit->unit_staf_id) selected="selected" @endif>{{ $rowUnit->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('unit'))<span class="help-block">{{ $errors->first('name') }}.</span>@endif
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
</div>

<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            {{ $unit->nama_lengkap }}
        </header>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#soft" role="tab" data-toggle="tab">Inti dan Manajerial</a></li>
                <li><a href="#hard" role="tab" data-toggle="tab">Fungsional</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="soft">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Kode Kompetensi</th>
                            <th>Nama Kompetensi</th>
                            <th>RCL</th>
                            <th>ITJ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($softProfiles as $profile)
                        <tr>
                            <th><a href="{{ url('competency/dictionary/detail/'.$profile->competency_dictionary->id.'') }}">{{ $profile->competency_dictionary->code }}</a></th>
                            <th>{{ $profile->competency_dictionary->title }}</th>
                            <th>{{ $profile->rcl }}</th>
                            <th>{{ $profile->itj }}</th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="hard">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Kode Kompetensi</th>
                            <th>Nama Kompetensi</th>
                            <th>RCL</th>
                            <th>ITJ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hardProfiles as $profile)
                        <tr>
                            <th><a href="{{ url('competency/dictionary/detail/'.$profile->competency_dictionary->id.'') }}">{{ $profile->competency_dictionary->code }}</a></th>
                            <th>{{ $profile->competency_dictionary->title }}</th>
                            <th>{{ $profile->rcl }}</th>
                            <th>{{ $profile->itj }}</th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@stop

@section('customjs')
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript">
    $(".select-2").select2();
</script>
@stop
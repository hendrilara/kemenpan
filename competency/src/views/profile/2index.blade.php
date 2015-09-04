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
                        @foreach($units as $unit)
                        <option value="{{ $unit->unit_staf_id }}">{{ $unit->nama_lengkap }}</option>
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
@stop

@section('customjs')
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript">
    $(".select-2").select2();
</script>
@stop
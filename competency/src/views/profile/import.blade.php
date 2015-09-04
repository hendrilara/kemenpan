@section('customcss')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.css') }}">
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
            {{ Form::open(array('url' => url('competency/profile/doImport'), 'files' => true, 'class' =>
            'form-horizontal tasi-form', 'method' => 'post')) }}
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-3">Pilih jabatan</label>-->
<!---->
<!--                <div class="col-md-3 col-xs-11">-->
<!--                    <select class="form-control select-2">-->
<!--                        <option>1</option>-->
<!--                        <option>2</option>-->
<!--                        <option>3</option>-->
<!--                        <option>4</option>-->
<!--                        <option>5</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
            <div class="form-group">
                <label class="control-label col-md-3">Upload Excel</label>

                <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                <input type="file" class="default" name="excel">
                            </span>
                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                           style="float: none; margin-left:5px;"></a>
                    </div>
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
<script type="text/javascript" src="{{ asset('assets/bootstrap-fileupload/bootstrap-fileupload.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript">
    $(".select-2").select2();
</script>
@stop
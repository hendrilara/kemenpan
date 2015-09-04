@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    @if(isset($data)){{ $data->code }} - {{ $data->title }}@else Tambah Data @endif
                        <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk menambah atau merubah daftar kamus kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>

                <div class="panel-body">
                    {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                    <div class="form-group @if ($errors->has('type_id')) has-error @endif">
                        <label class="control-label col-md-2">Tipe Kompetensi</label>
                        <div class="col-md-10">
                            <select class="form-control" name="type_id">
                                @foreach($dataType as $type)
                                <option value="{{ $type->id }}" @if((isset($data)) && ($data->type_id == $type->id)) selected="selected" @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type_id'))<span class="help-block">{{ $errors->first('type_id') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('code')) has-error @endif">
                        <label class="control-label col-md-2">Kode Kompetensi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Kode kompetensi" name="code" value="@if((isset($data)) && (isset($data->code))){{ $data->code }}@endif">
                            @if ($errors->has('code'))<span class="help-block">{{ $errors->first('code') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('title')) has-error @endif">
                        <label class="control-label col-md-2">Nama Kompetensi</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Nama kompetensi" name="title" value="@if((isset($data)) && (isset($data->title))){{ $data->title }}@endif">
                            @if ($errors->has('title'))<span class="help-block">{{ $errors->first('title') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('parent')) has-error @endif">
                        <label class="control-label col-md-2">Kompetensi Kepala</label>
                        <div class="col-md-10">
                            <select class="form-control" name="parent">
                                <option value="0" @if((isset($data)) && ($data->parent == 0)) selected @endif> -- </option>
                                @foreach($dataParent as $parent)
                                    <option value="{{ $parent->id }}" @if((isset($data)) && ($data->$parent == $parent->id)) selected @endif>{{ $parent->code }} - {{ $parent->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent'))<span class="help-block">{{ $errors->first('parent') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                        <label class="control-label col-md-2">Deskripsi</label>
                        <div class="col-md-10">
                            <textarea class="form-control ckeditor" name="description" rows="6">@if((isset($data)) && (isset($data->description))){{ $data->description }}@endif</textarea>
                            @if ($errors->has('title'))<span class="help-block">{{ $errors->first('title') }}.</span>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('cakupan')) has-error @endif">
                        <label class="control-label col-md-2">Cakupan</label>
                        <div class="col-md-10">
                            <?php if(isset($data)): $detail = json_decode($data->detail); endif; ?>
                            <textarea class="form-control ckeditor" name="cakupan" rows="6">@if((isset($data)) && (isset($detail->cakupan))){{ $detail->cakupan }}@endif</textarea>
                            @if ($errors->has('cakupan'))<span class="help-block">{{ $errors->first('cakupan') }}.</span>@endif
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
    </div>
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_dic").addClass("active");
        $( "#help_app" ).tooltip();
    </script>

@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Dashboard
                </header>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <div class="alert alert-success fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    {{ Form::open(array('url' => Request::url(), 'class' =>'form-horizontal tasi-form', 'method' => 'post')) }}
                    <div class="form-group @if ($errors->has('code')) has-error @endif">
                        <label class="control-label col-md-2">Kata Sandi Baru</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="newpassword">
                            @if ($errors->has('newpassword'))<span class="help-block">{{ $errors->first('newpassword') }}.</span>@endif
                        </div>
                    </div>
                    <div class="form-group @if ($errors->has('code')) has-error @endif">
                        <label class="control-label col-md-2">Konfirmasi Kata Sandi</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="newpassword_confirmation">
                            @if ($errors->has('newpassword_confirmation'))<span class="help-block">{{ $errors->first('newpassword_confirmation') }}.</span>@endif
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
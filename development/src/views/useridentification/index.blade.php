@section('content')
<div class="row">
    <div class="col-lg-12">
        
        <div class="panel">
            <div class="panel-body">
                {{ Form::open(array('url' => Request::url(), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label for="Tahun Cli" class="col-lg-2 col-sm-2 control-label">Tahun Cli</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="cli">
                            @foreach($competencyAll as $row)
                                <option value="{{ $row->id }}">{{ $row->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Check</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
@if(isset($recapInv))
 <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Profil Kompetensi
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk melihat profil kompetensi karyawan berdasar tipe kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>
                 <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Unit Kerja</th>
                            <td></td>
                        </tr>
                    </table>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Hasil Kompetensi Individu
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kompetensi</th>
                            <th>ITJ</th>
                            <th>RCL</th>
                            <th>CCL</th>
                            <th>GAP</th>
                            <th>Prioritas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recapInv as $rowRecap)
                            <tr @if($rowRecap->gap < 0)class="danger"@endif>
                                <td>{{ $rowRecap->dictionary->code }}</td>
                                <td>{{ $rowRecap->dictionary->title }}</td>
                                <td>{{ $rowRecap->itj }}</td>
                                <td>{{ $rowRecap->rcl }}</td>
                                <td>{{ $rowRecap->ccl }}</td>
                                <td>{{ $rowRecap->gap }}</td>
                                <td>{{ $rowRecap->priority }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
<!--@endif-->

@stop

@section('customjs')
    <script type="text/javascript">
        $("#menu_dev").addClass("active");
        $("#menu_dev_identification").addClass("active");
    </script>
@stop
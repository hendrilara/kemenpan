@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{ $data->code }} - {{ $data->title }}
                    <a href="javascript:void(0)" id="help_app" title="Halaman ini digunakan untuk melihat detail daftar kamus kompetensi"><i class="fa fa-question-circle"></i></a>
                </header>

                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <tbody>
                        <tr>
                            <th>Tipe</th>
                            <td>{{ $data->type_id }}</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>{{ $data->code }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $data->title }}</td>
                        </tr>
                        <tr>
                            <th>Kepala</th>
                            <td>@if(count($data->kepala) > 0){{ $data->kepala->code }} - {{ $data->kepala->title }}@endif</td>
                        </tr>
                        <tr>
                            <th>Deksripsi</th>
                            <td>{{ $data->description }}</td>
                        </tr>
                        <tr>
                            <th>Cakupan</th>
                            <?php $detail = json_decode($data->detail);?>
                            <td>{{ $detail->cakupan }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_dic").addClass("active");
        $( "#help_app" ).tooltip();
    </script>

@stop
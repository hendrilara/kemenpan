@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Daftar tipe kompetensi
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk memilih tipe kompetensi yang akan diukur"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kemajuan</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($listData as $data)
                            <tr>
                                <td> {{ $data->name }} </td>
                                <td>
                                    <?php
                                    $totalProfile = count(\Meniqa\Competency\Models\CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $competencyData->id, $data->id));
                                    $checkProfile = count(\Meniqa\Competency\Models\CompetencyProfile::checkTestInv($user->nip, $riwJabatan->unit_staf_id, $competencyData->id, $data->id));
                                    ?>
                                    {{ $totalProfile - $checkProfile }} pengisian dari {{ $totalProfile }} kompetensi
                                </td>
                                <td>
                                    <a href="{{ url('competency/test/inv/type/'.$data->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Pengukuran</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    {{ $listData->links('layouts.backend.pagination')}}
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript">
        $("#menu_comp").addClass("active");
        $("#menu_comp_pen").addClass("active");
        $("#menu_comp_pen_dir").addClass("active");
        $( "#help_app" ).tooltip();
    </script>
@stop
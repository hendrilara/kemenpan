@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Kemajuan Pengisian Kompetensi Individu
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk melihat kemajuan pengisian kompetensi individu"><i class="fa fa-question-circle"></i></a>
                </header>

                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $i=0;?>
                        @foreach($data as $rowData)
                            <li @if($i == 0)class="active"@endif><a href="#type{{ $rowData['type']['id'] }}" role="tab" data-toggle="tab">{{ $rowData['type']['name'] }}</a></li>
                            <?php $i++;?>
                        @endforeach
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php $i=0;?>
                        @foreach($data as $rowData)

                            <div class="tab-pane @if($i == 0)active@endif" id="type{{ $rowData['type']['id'] }}">
                                <table class="table table-bordered table-striped table-advance table-hover">
                                    <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Judul</th>
                                        <th>Evidence</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($rowData['profile']) > 0)
                                        @foreach($rowData['profile'] as $rowProfile)
                                            <?php $answer = \Meniqa\Competency\Models\CompetencyTest::checkTest($rowProfile->competency_dictionary_id, Auth::user()->nip, Auth::user()->nip) ?>
                                            <tr>
                                                <td>{{ $rowProfile->code }}</td>
                                                <td>{{ $rowProfile->title }}</td>
                                                <td>@if(!is_null($answer)){{ $answer->evidence }}@else -- @endif</td>
                                                <td>@if(!is_null($answer)){{ $answer->dictionarylevel->title }}@else -- @endif</td>
                                                <td>
                                                    @if(is_null($answer))
                                                        <a href="{{ url('competency/test/inv/update/'.$rowProfile->competency_dictionary_id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Isi Data</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <?php $i++;?>

                        @endforeach
                    </div>
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
        $("#menu_comp_pen").addClass("active");
        $("#menu_comp_pen_kem").addClass("active");
        $("#menu_comp_pen_kem_dir").addClass("active");
        $( "#help_app" ).tooltip();
    </script>
@stop
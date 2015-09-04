@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Daftar tipe kompetensi
                    <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk memilih atasan, bawahan atau kolega yang akan diukur"><i class="fa fa-question-circle"></i></a>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th>Inti dan Manajerial</th>
                            <th>Fungsional</th>
                            {{--<th>Kemajuan</th>--}}
                            {{--<th style="width: 15%">Aksi</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key)
                            <tr>
                                <td> {{ $key['nama'] }} </td>
                                <td> {{ $key['status'] }}</td>
                                <td> {{ $key['jabatan'] }}</td>
                                <td>
                                    @if(($key['status'] == 'bawahan level 1') OR ($key['status'] == 'atasan') OR ($key['status'] == 'kolega') OR ($key['status'] == 'customer'))
                                    <a href="{{ url('competency/test/prs/action/1/'.$key['id']) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Pengukuran</a>
                                    <br/>
                                    {{ $key['progressSoft'] }}
                                    @endif
                                </td>
                                <td>
                                    @if(($key['status'] == 'bawahan level 1') OR ($key['status'] == 'bawahan level 2'))
                                    <a href="{{ url('competency/test/prs/action/2/'.$key['id']) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Pengukuran</a>
                                    <br/>
                                    {{ $key['progressManagerial'] }}
                                    @endif
                                </td>
                                {{--<td> {{ $key['progress'] }}</td>--}}
                                {{--<td>--}}
                                    {{--<a href="{{ url('competency/test/prs/action/'.$key['id']) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Pengukuran</a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
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
        $("#menu_comp_pen").addClass("active");
        $("#menu_comp_pen_ora").addClass("active");
        $( "#help_app" ).tooltip();
    </script>
@stop
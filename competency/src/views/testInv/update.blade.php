@section('content')
    <section class="panel">
        <header class="panel-heading">
            Pengukuran Individu
            <a href="javascript:void(0)" id="help_app" title="halaman ini digunakan untuk melakukan penilaian kompetensi diri sendiri"><i class="fa fa-question-circle"></i></a>
        </header>
        <div class="panel-body">

                <ul class="list-group">

                    <li class="list-group-item">
                        <h2 class="list-group-item-heading">Kompetensi : {{ $dict->title }} ( {{ $dict->code }} )</h2>
                        <!--h2 class="list-group-item-heading"> </h2-->
                        <h3>Definisi <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Uraian dari kompetensi yang akan diukur" data-placement="right" data-trigger="hover" class="popovers"/></h3>
                        <?php
                        if ($dict->description == null){
                            $compParent = \Meniqa\Competency\Models\CompetencyDictionary::find($dict->parent);
                            if($compParent != null)
                                $description = $compParent->description;
                        }else{
                            $description = $dict->description;
                        }
                        ?>
                        <p class="list-group-item-text">{{ $description}}</p>
                        <h3>Cakupan <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Cakupan dari kompetensi yang akan diukur" data-placement="right" data-trigger="hover" class="popovers"/></h3>
                        <?php
                        $detail = json_decode($dict->detail);
                        if ($detail->cakupan == null){
                            $compParent = \Meniqa\Competency\Models\CompetencyDictionary::find($dict->parent);
                            if($compParent != null)
                                $detail = json_decode($compParent->detail);
                        }
                        ?>
                        <p class="list-group-item-text">{{ $detail->cakupan or '' }}</p>
                    </li>
                    {{ Form::open(array('url' => Request::url() , 'method' => 'post')) }}

                    <li class="list-group-item">

                        <h3>Bukti Perilaku <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Tuliskan peristiwa yang pernah dialami (pengalaman) selama 2 tahun terakhir, yang menunjukkan bukti perilaku sesuai dengan kompetensi yang diukur" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                        <textarea class="form-control ckeditor" name="evidence" rows="2" required min="10   " title="Wajib Di Isi"></textarea>

                    </li>

                    <li class="list-group-item">

                        <input type="hidden" name="kompetensi" value="{{ $dict->competency_dictionary_id }}">

                        <h3>Pilihan Cakupan Kompetensi <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Pilih cakupan kompetensi yang sesuai dengan bukti perilaku, kemudian klik tombol di sebelah kiri" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                        <table class="table table-bordered">
                            <tbody>
                            <?php
                            $levels = \Meniqa\Competency\Models\CompetencyDictionaryLevel::where('dictionary_id', '=', $dict->id)->orderByRaw("RAND()")->get();
                            //$array = iterator_to_array($optionLevel[0]->leveldimensi,true); shuffle($array);
                            ?>
                            @foreach($levels as $level)
                                <tr>
                                    <td rowspan="3">
                                        <input type="radio" name="level" value="{{ $level->id }}" required title="Wajib Di Isi">
                                    </td>
                                    <td>definisi</td>
                                    <td>{{ $level->title }}</td>
                                </tr>
                                <tr>
                                    <td>deskripsi</td>
                                    <td>{{ $level->description }}</td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table>

                    </li>



                    <li class="list-group-item">
                        <input type="hidden" name="compId" value="{{ $dict->id }}">
                        <input type="submit" value="Selanjutnya"  class="btn btn-primary"/>


                    </li>
                    {{ Form::close() }}

                </ul>


        </div>
        </div>
    </section>
@stop

@section('customcss')
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
@stop

@section('customjs')
    <script type="text/javascript" src="{{asset('/assets/jqBootstrapValidation/jqBootstrapValidation.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script>
        $("#menu_comp").addClass("active");
        $("#menu_comp_pen").addClass("active");
        $("#menu_comp_pen_dir").addClass("active");
        $( "#help_app" ).tooltip();
        $(function () { $("select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
    </script>
@stop
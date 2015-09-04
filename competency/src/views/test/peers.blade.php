@section('customcss')
@stop

@section('content')
    <section class="panel">
        <header class="panel-heading">Pengukuran Individu</header>
        <div class="panel-body">
            <ul class="list-group">
                {{ Form::open(array('url' => Request::url() , 'method' => 'post', 'id' => 'formcli')) }}
                <li class="list-group-item">
                    <h3 class="list-group-item-heading">Kompetensi : {{ $profiles->competencyDictionary->title }} ( {{ $profiles->competency_dictionary->code }} )</h3>
                    <!--h2 class="list-group-item-heading"> </h2-->
                    <h3>Definisi <img alt src=" {{ URL::asset('img/help.png') }}" data-trigger="hover" class="popovers" data-placement="right" data-original-title="Uraian dari kompetensi yang akan diukur"/></h3>
                    <p class="list-group-item-text">{{ $profiles->competency_dictionary->description }} </p>
                </li>

                <li class="list-group-item">

                    <input type="hidden" name="kompetensi" value="{{ $profiles->competencyDictionary->id }}">

                    <h3>Pilihan Cakupan Kompetensi <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Daftar cakupan kompetensi yang digunakan sebagai referensi untuk mengukur orang lain" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                    <table class="table table-bordered">
                        <tbody>
                        <?php
                        //$array = iterator_to_array($optionLevel[0]->leveldimensi,true); shuffle($array);
                        ?>
                        @foreach($profiles->competency_dictionary->level as $level)
                            <tr>
                                <td>{{$level->id }} </td>
                                <td>
                                    <strong>{{ $level->title }}</strong></br>
                                    {{ $level->description }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </li>

                <li class="list-group-item">
                    <h3>Pengukuran Atasan, Bawahan, dan Kolega <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Berikut ini adalah daftar atasan, bawahan dan kolega yang harus diukur kompetensinya. Untuk melakukan pengukuran klik salah satu pilihan berikut (1 sampai dengan 6) sesuai dengan cakupan kompetensi diatas" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Nomor</td>
                            <td>Nama</td>
                            <td colspan="6">Pilihan</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  $i=1; ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> {{ $user->pegawai->nama_cetak }} </td>
                                <?php
                                //mencari value dari jawaban sebelum nya
                                $answer = \Meniqa\Competency\Models\CompetencyTest::where('competency_id', '=', $competencyId)->where('rater_id', '=', Auth::user()->nip)->where('user_id', '=', $user->pegawai->nip)->where('competency_dictionary_id', '=',$profiles->competencyDictionary->id )->first();
                                ?>
                                @foreach($profiles->competency_dictionary->level as $level)
                                    <td><input type="radio" name="level[{{ $user->pegawai->nip }}]" value="{{ $level->value }}" required  @if((!is_null($answer)) && (!is_null($answer->level)) && ($answer->level == $level->value)) checked="checked" @endif /> {{ $level->id }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </li>

                <li class="list-group-item">
                    <button type="submit" class="btn btn-primary"> Selanjutnya </button>
                </li>

                {{ Form::close() }}
            </ul>

        </div>
        </div>
    </section>
@stop

@section('customjs')
    {{ HTML::script('assets/jqBootstrapValidation/jqBootstrapValidation.js')}}
    <script>
        $(function () {
                    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); }
        );
    </script>
@stop
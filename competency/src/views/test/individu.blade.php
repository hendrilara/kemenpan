@section('content')
<section class="panel">
    <header class="panel-heading">Pengukuran Individu</header>
    <div class="panel-body">
        <ul class="list-group">

            <li class="list-group-item">
                <h2 class="list-group-item-heading">Kompetensi : {{ $profiles->competencyDictionary->title }} ( {{ $profiles->competency_dictionary->code }} )</h2>
                <!--h2 class="list-group-item-heading"> </h2-->
                <h3>Definisi <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Uraian dari kompetensi yang akan diukur" data-placement="right" data-trigger="hover" class="popovers"/></h3>
                <p class="list-group-item-text">{{ $profiles->competency_dictionary->description }}</p>
            </li>

            <li class="list-group-item">
                {{ Form::open(array('url' => Request::url() , 'method' => 'post')) }}
                <input type="hidden" name="kompetensi" value="{{ $profiles->competencyDictionary->id }}">

                <h3>Pilihan Cakupan Kompetensi <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Pilih cakupan kompetensi yang sesuai dengan bukti perilaku, kemudian klik tombol di sebelah kiri" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                <table class="table table-bordered">
                    <tbody>
                    <?php
                    //$array = iterator_to_array($optionLevel[0]->leveldimensi,true); shuffle($array);
                    ?>
                    @foreach($profiles->competency_dictionary->level as $level)
                    <tr>
                        <td rowspan="3">
                            <input type="radio" name="level" value="{{ $level->id }}">
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

                <h3>Bukti Perilaku <img alt src=" {{ URL::asset('img/help.png') }}" data-original-title="Tuliskan peristiwa yang pernah dialami (pengalaman) selama 2 tahun terakhir, yang menunjukkan bukti perilaku sesuai dengan kompetensi yang diukur" data-placement="right" data-trigger="hover" class="popovers"/></h3>

                <textarea class="form-control ckeditor" name="evidence" rows="2" required title="Wajib Di Isi"></textarea>

            </li>

            <li class="list-group-item">
                <input type="hidden" name="compId" value="{{ $profiles->competencyDictionary->id }}">
                <input type="submit" value="Selanjutnya"  class="btn btn-primary"/>

                </form>
            </li>


        </ul>


    </div>
    </div>
</section>
@stop

@section('customjs')
{{ HTML::script('assets/jqBootstrapValidation/jqBootstrapValidation.js')}}
<script>
    $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
@stop
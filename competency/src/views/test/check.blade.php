@section('content')
<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            Cek Progress Pengukuran
        </header>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#soft" role="tab" data-toggle="tab">Inti dan Manajerial</a></li>
                <li><a href="#hard" role="tab" data-toggle="tab">Fungsional</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="soft">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Kode Kompetensi</th>
                            <th>Nama Kompetensi</th>
                            <th>level</th>
                            <th>Evidence</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($softProfiles as $profile)
                        <tr>
                            <th><a href="{{ url('competency/dictionary/detail/'.$profile->competency_dictionary->id.'') }}">{{ $profile->competency_dictionary->code }}</a></th>
                            <th>{{ $profile->competency_dictionary->title }}</th>
                            <?php
                            $test = \Meniqa\Competency\Models\CompetencyTest::where('user_id', '=', $userId)->where('rater_id', '=', $userId)->where('competency_dictionary_id', '=', $profile->competency_dictionary->id)->first();
                            ?>
                            <th>@if(is_null($test)) - @else {{ $test->level }}@endif</th>
                            <th>@if(is_null($test)) - @else {{ $test->evidence }}@endif</th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="hard">
                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Kode Kompetensi</th>
                            <th>Nama Kompetensi</th>
                            <th>Level</th>
                            <th>Evidence</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hardProfiles as $profile)
                        <tr>
                            <th><a href="{{ url('competency/dictionary/detail/'.$profile->competency_dictionary->id.'') }}">{{ $profile->competency_dictionary->code }}</a></th>
                            <th>{{ $profile->competency_dictionary->title }}</th>
                            <?php
                            $test = \Meniqa\Competency\Models\CompetencyTest::where('user_id', '=', $userId)->where('rater_id', '=', $userId)->where('competency_dictionary_id', '=', $profile->competency_dictionary->id)->first();
                            ?>
                            <th>@if(is_null($test)) - @else {{ $test->level }}@endif</th>
                            <th>@if(is_null($test)) - @else {{ $test->evidence }}@endif</th>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@stop
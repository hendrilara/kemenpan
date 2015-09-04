@section('customcss')
@stop

@section('content')
<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            {{ $dictionary->title }} ( {{ $dictionary->code }} )
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $dictionary->description }}</td>
                </tr>
                <tr>
                    <th>Cakupan</th>
                    <?php $detail = json_decode($dictionary->detail);?>
                    <td>{{ $detail->cakupan }}</td>
                </tr>
            </table>
        </div>
    </section>
</div>

<div class="col-md-12">
    <section class="panel">
        <header class="panel-heading">
            Level
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                <tr>
                    <th>nilai</th>
                    <th>Deskripsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dictionary->level as $level)
                <tr>
                    <td> {{ $level->value }}</td>
                    <td>
                        <p><strong>{{ $level->title }}</strong></p>
                        <p>{{ $level->description }}</p>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@stop

@section('customjs')

@stop
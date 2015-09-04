@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Daftar unit Kerja
            </header>
            <table class="table table-bordered table-striped table-advance table-hover">
                <thead>
                <tr>
                    <th>Unit Id</th>
                    <th>Nama</th>
                    <th>Eselon</th>
                    <th>ket</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($units as $unit)
                <tr>
                    <td> {{ $unit->unit_id }} </td>
                    <td>{{ $unit->nama }}</td>
                    <td>{{ $unit->eselon_id }}</td>
                    <td>{{ $unit->ket }}</td>
                    <td>
                        <a href="{{ url('competency/dictionary/unit/download/'.$unit->unit_id) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> Unduh Kamus</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>


{{ $units->links('layouts.backend.pagination')}}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				TalentPool
				<a href="javascript:void(0)" id="help_app" title="Menu Ini menampilkan Nilai Karyawan dengan hasil berdasarkan TalentPool"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
            	{{Form::open(array('url' => 'career/talentpool',  'method'=>'post')) }}
            	<div class = "col-lg-1"></div>
            	<div class="col-lg-6">
                	<input type="text" class="form-control pull-left" name="cari" placeholder="Pencarian">
                </div>
                <div class="col-lg-4">
                	<button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {{Form::close()}}
                {{Form::close()}}
				<div class="col-lg-12">
					
					<section class="panel">
					  <div class="panel-body">
						<table  class="display table table-bordered table-striped" id="dtable">
						<thead>
						<tr>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>
							<th>Golongan</th>
							<th>Nilai Kinerja</th>
							<th>Nilai Kompetensi</th>
							<th>Area/Nilai</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($talent as $key)
						<tr>
							<td>{{$key->nama }}</td>
							<td>{{$key->nama_lengkap}}</td>
							<td>{{$key->pangkat}} - {{$key->golongan}}</td>
							<td>{{$key->nilai_kinerja}}</td>
							<td>{{$key->nilai_kompetensi}}</td>
							<td>
								@if(($key->nilai_kinerja >= 76 && $key->nilai_kinerja <=90)&&($key->nilai_kompetensi >= 60 && $key->nilai_kompetensi <=79))
								{{"5"}}
								@elseif(($key->nilai_kinerja >= 76 && $key->nilai_kinerja <=90)&&($key->nilai_kompetensi >= 80 && $key->nilai_kompetensi <=100))
								{{"8"}}
								@elseif(($key->nilai_kinerja >= 91 && $key->nilai_kinerja <=100)&&($key->nilai_kompetensi >= 60 && $key->nilai_kompetensi <=79))
								{{"7"}}
								@elseif(($key->nilai_kinerja >= 91 && $key->nilai_kinerja <=100)&&($key->nilai_kompetensi >= 80 && $key->nilai_kompetensi <=100))
								{{"9"}}
								@elseif(($key->nilai_kinerja >= 0 && $key->nilai_kinerja <=75)&&($key->nilai_kompetensi >= 0 && $key->nilai_kompetensi <=59))
								{{"1"}}
								@elseif(($key->nilai_kinerja >= 0 && $key->nilai_kinerja <=75)&&($key->nilai_kompetensi >= 60 && $key->nilai_kompetensi <=79))
								{{"3"}}
								@elseif(($key->nilai_kinerja >= 0 && $key->nilai_kinerja <=75)&&($key->nilai_kompetensi >= 80 && $key->nilai_kompetensi <=100))
								{{"6"}}
								@elseif(($key->nilai_kinerja >= 76 && $key->nilai_kinerja <=90)&&($key->nilai_kompetensi >= 0 && $key->nilai_kompetensi <=59))
								{{"2"}}
								@elseif(($key->nilai_kinerja >= 91 && $key->nilai_kinerja <=100)&&($key->nilai_kompetensi >= 0 && $key->nilai_kompetensi <=59))
								{{"4"}}
								@else
								{{" Tidak Memenuhi Syarat "}}
								@endif
								</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					{{$talent->links()}}
					  </div>
					</section>
				</div>
			</div>
        </section>
    </div>
</div>

@stop

@section('customcss')
<link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
<link href="{{asset('assets/advanced-datatable/media/css/demo_table.css')}}" rel="stylesheet" />
@stop

@section('customjs')
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script type="text/javascript" language="javascript" src="{{asset('assets/advanced-datatable/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/data-tables/DT_bootstrap.js')}}"></script>
<script>
$("#menu_atur").addClass("active");
$("#menu_atur_at").addClass("active");
$("#menu_atur_at_tal").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
$(document).ready(function() {
	$( "#help_app" ).tooltip();
	$('#dtable').dataTable( {
		"sDom": '',
		"aaSorting": [[ 7, "desc" ]]
	} );
} );
</script>

@stop
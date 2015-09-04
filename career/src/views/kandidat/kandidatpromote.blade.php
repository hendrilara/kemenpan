@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Kandidat Promosi Jabatan
				<a href="javascript:void(0)" id="help_app" title="Menu Ini Menampilkan Data Karyawan Yang telah Memenuhi Syarat TalentPool Yang Kemudian Akan Ditambahkan Pada Jadwal Asessment"><i class="fa fa-question-circle"></i></a>
            </header>
           <div class="panel-body">
            	{{Form::open(array('url' => 'career/kandidat/promosi',  'method'=>'post')) }}
            	<div class = "col-lg-2"></div>
            	<div class="col-lg-6">
                	  <select id="complete" class="form-control select" name="cari" >
										 	<option value="">----</option>
										 	@foreach($dafunit as $dafunitt)
										 		<option value="{{$dafunitt->unit_staf_id}}"> {{$dafunitt->nama_lengkap}}</option>
										 	@endforeach
										</select>
                </div>
                <div class="col-lg-4">
                	<button type="submit" class="btn btn-primary">Cari</button>
                </div>

                {{Form::close()}}
				<div class="col-lg-12">
					<?php if(isset($comment)): echo $comment; endif;?>
					@if(Session::has('messagess')):<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>{{ Session::get('messagess') }}</div>@endif
					@if(Session::has('message')):<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>{{ Session::get('message') }}</div>@endif
					<section class="panel">
					  <div class="panel-body">
					  	@if(isset($unit))
						<table class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Nama Pegawai</th>
							<th>Jabatan</th>
							<th>Golongan</th>
							<th>Nilai Kinerja</th>
							<th>Nilai Kompetensi</th>
							<th>Area/Nilai</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
							@foreach($unit as $record)
						<tr>
							<td>{{$record->nama}}</td>
							<td>{{$record->nama_lengkap}}</td>
							<td>{{$record->pangkat}} - {{$record->golongan}}</td>
							<td>{{$record->nilai_kinerja}}</td>
							<td>{{$record->nilai_kompetensi}}</td>
								<td>
								@if(($record->nilai_kinerja >= 76 && $record->nilai_kinerja <=90)&&($record->nilai_kompetensi >= 60 && $record->nilai_kompetensi <=79))
								{{"5"}}
								@elseif(($record->nilai_kinerja >= 76 && $record->nilai_kinerja <=90)&&($record->nilai_kompetensi >= 80 && $record->nilai_kompetensi <=100))
								{{"8"}}
								@elseif(($record->nilai_kinerja >= 91 && $record->nilai_kinerja <=100)&&($record->nilai_kompetensi >= 60 && $record->nilai_kompetensi <=79))
								{{"7"}}
								@elseif(($record->nilai_kinerja >= 91 && $record->nilai_kinerja <=100)&&($record->nilai_kompetensi >= 80 && $record->nilai_kompetensi <=100))
								{{"9"}}
								@elseif(empty($record->nilai_kinerja) && empty($record->nilai_kompetensi))
								
								@else
								{{" Tidak Memenuhi Syarat "}}
								@endif
								</td>
							<td></td>
							<td>@if(isset($record->nilai_kinerja) && isset($record->nilai_kompetensi) && isset($record->nilai))<a href="{{ url('career/kandidat/tambahkan/kandidat/'. $record->unit_staf_id) }}" >Tambahkan Kandidat</a>@endif</td>
						</tr>
							@endforeach
						</tbody>
					</table>
					@endif
					  </div>
					</section>
				</div>
				</div>
			</div>
        </section>
    </div>
</div>

@stop

@section('customcss')
<link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
<link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
@stop

@section('customjs')
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script>
$("#menu_atur").addClass("active");
$("#menu_atur_at").addClass("active");
$("#menu_atur_at_kand").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
	$("#complete").select2();
	  $('.select').on("change", function(e){
//            var selectId = $(this).val();
            $('#orderForm').submit();
            e.preventDefault();
        });
	  $(".alert").alert()
</script>

@stop
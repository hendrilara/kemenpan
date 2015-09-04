@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Jadwal Asessment
				<a href="javascript:void(0)" id="help_app" title="Halaman Ini Menampilkan Karyawan Yang telah Terseleksi Dari Prasyarat dan Nilai Yang dipersyaratkan Memenuhi "><i class="fa fa-question-circle"></i></a>
            </header>
           <div class="panel-body">
           		{{Form::open(array('url' => 'career/jadwal/lihat/asessment',  'method'=>'post')) }}
            	<div class="col-lg-2"></div>
            	<div class="col-lg-6">
                	<select class="form-control" name="tahun">
                		@foreach($tahun['0'] as $th) <option value="{{$th}}">{{$th}}</option>@endforeach
                	</select>
                </div>
                <div class="col-lg-4">
                	<button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {{Form::close()}}
				<div class="col-lg-12">
					<section class="panel">
					  <div class="panel-body">
					  	@if(isset($data))
						<table class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Nama Jabatan</th>
							<th>Tanggal Mulai</th>
							<th>Tanggal Asessment</th>
							<th>Tanggal berakhir</th>
							<th>Detail</th>
							<th>Aksi</th>
						</tr>
						</thead>
						@foreach($data as $dat)
						<?php
						//tanggal awal
						$da=explode("-",$dat->tgl_awal);
						$th = $da[0];
						$bln = $da[1];
						$ss = $da[2];
						$da1 = explode(" ",$ss);
						$tgl = $da1[0];
						//tanggal asesment 
						$datat=explode("-",$dat->tgl_asesment);
						$tahun = $datat[0];
						$bulan = $datat[1];
						$sisa = $datat[2];
						$datat1 = explode(" ",$sisa);
						$tanggal = $datat1[0];
						//tanggal selesai
						$datuk=explode("-",$dat->tgl_selesai);
						$tn = $datuk[0];
						$bl = $datuk[1];
						$sis = $datuk[2];
						$datuk1 = explode(" ",$sis);
						$tl = $datuk1[0];
						 ?>
						<tbody>
						<tr>
							<td>{{$dat->nama_lengkap}}</td>
							<td>{{$th}}-{{$bln}}-{{$tgl}}</td>
							<td>{{$tahun}}-{{$bulan}}-{{$tanggal}}</td>
							<td>{{$tn}}-{{$bl}}-{{$tl}}</td>
							<td>{{$dat->detail}}</td>
							<td><a href="{{ url('career/jadwal/proses/hapus/'. $dat->id) }}" onClick="return confirm('Apakah anda akan menghapus data ini?');">Hapus Kandidat</a></td>
						</tr>
							
						</tbody>
						@endforeach
					</table>
					<a href="{{ url('#')}}"  class="btn btn-primary">Rekap Jadwal Asessment Karyawan</a>
					
					{{$data->links()}}
					@else
					<div class="alert alert-warning"><a class="close" data-dismiss="alert">&times;</a>Silahkan Cari Tahun Asesment Karyawan.</div>
					@if(Session::has('message')):<div class="alert alert-success"><a class="close" data-dismiss="alert">&times;</a>{{ Session::get('message') }}</div>@endif
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
$("#menu_atur_at_jad").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
$(".alert").alert()
</script>

@stop
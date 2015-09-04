@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Pengaturan Eselon Jabatan
				<a href="javascript:void(0)" id="help_app" title="Halaman Ini Untuk Menambahkan dan Mengumpulkan Data Jabatan Pada Eselon Jabatan"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
            	<a href="{{ url('career/jabatan/tambah') }}" class="btn btn-primary pull-left">Tambah Data</a>
            	{{Form::open(array('url' => 'career/jabatan',  'method'=>'post')) }}
            	<div class="col-lg-6">
                	<input type="text" class="form-control pull-left" name="cari" placeholder="Pencarian">
                </div>
                <div class="col-lg-4">
                	<button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {{Form::close()}}
				<div class="col-lg-12">
					@if(Session::has('messagess')):<div class="alert alert-danger">{{ Session::get('messagess') }}</div>@endif
					@if(Session::has('message')):<div class="alert alert-success">{{ Session::get('message') }}</div>@endif
				    
					<section class="panel">
					  <div class="panel-body">
						<table class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Jabatan</th>
							<th>Kelas Jabatan</th>
							<th>Eselon</th>
							<th>Unit</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($asesment as $key)
						<tr>
							<td>{{  $key->nama_lengkap }}</td>
							<td>{{  $key->jabatan }}</td>
							<td>{{  $key->nama_tipe }}</td>
							<td>{{  $key->unit }}</td>
							<td><a href="{{ url('career/jabatan/ubah/'. $key->id) }}" >Ubah</a>
								| <a href="{{ url('career/jabatan/delete/'. $key->id) }}" onClick="return confirm('Apakah anda akan menghapus data ini?');">Delete</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					
					{{$asesment->links()}}
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
@stop

@section('customjs')
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script>
$("#menu_atur").addClass("active");
$("#menu_atur_at").addClass("active");
$("#menu_atur_at_jab").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
</script>

@stop
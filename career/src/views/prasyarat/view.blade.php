@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Pengaturan Prasyarat Jabatan
				<a href="javascript:void(0)" id="help_app" title="Menampilkan Data Prasyarat untuk jabatan"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
            	<div class="col-lg-2"></div>
            	{{Form::open(array('url' => 'career/prasyarat',  'method'=>'post')) }}
            	<div class="col-lg-6">
                	<input type="text" class="form-control pull-left" name="cari" placeholder="Pencarian">
                </div>
                <div class="col-lg-4">
                	<button type="submit" class="btn btn-primary">Cari</button>
                </div>
                {{Form::close()}}
				<div class="col-lg-12">
					@if(Session::has('messagess')):<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>{{ Session::get('messagess') }}</div>@endif
					@if(Session::has('message')):<div class="alert alert-success"><a class="close" data-dismiss="alert">&times;</a>{{ Session::get('message') }}</div>@endif
				    
					<section class="panel">
					  <div class="panel-body">
						<table class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Cek</th>
							<th>Nama jabatan</th>
							<th>Jumlah Prasyarat</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody>
						@foreach ($results as $key)
						<tr>
							<td>@if($key->nilai!=0){{ "<span class='glyphicon glyphicon-ok' style='color:green'></span>" }} @else {{"<span class='glyphicon glyphicon-remove' style='color:red'></span>"}} @endif</td>
							<td>{{  $key->jabatan }}</td>
							<td>@if($key->nilai!=0){{  $key->nilai }} @else {{"Belum Ditambahkan Prasyarat"}} @endif </td>
							<td>@if($key->nilai>0)<a href="{{ url('career/prasyarat/preview/'. $key->id)}}" style='color:green'>Preview</a> {{" | "}} <a href="{{ url('career/prasyarat/delete/'. $key->id)}}" style='color:green' onClick="return confirm('Apakah anda akan menghapus data ini?');">Hapus</a> @else <a href="{{ url('career/prasyarat/tambah/'.$key->id)}}" style='color:red'>Prasyarat</a> @endif  
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					
					{{ $results->links() }}
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
$("#menu_atur_at_prajab").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
$(".alert").alert()
</script>

@stop
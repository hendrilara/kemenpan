@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Preview Prasyarat Jabatan
				<a href="javascript:void(0)" id="help_app" title=""><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
				<div class="col-lg-12">
					<section class="panel">
					  <div class="panel-body">
						<table class="table table-bordered table-striped table-hover">
						<thead>
						<tr>
							<th>Nama jabatan</th>
							<th>Prasyarat Eselon Jabatan</th>
							<th>Prasyarat Jenjang Pendidikan</th>
						</tr>
						</thead>
						<tbody>
							<td>{{$data->jabatan}}</td>
							<td>@foreach($gol as $go) {{$go->pangkat." - ".$go->golongan.","}}  @endforeach</td>
							<td>@foreach($jnjang as $jen) {{$jen->nama.","}}  @endforeach</td>
						</tbody>
					</table>
					<a href="{{ url('career/prasyarat') }}" class="btn btn-primary pull-left">Kembali Ke Menu Prasyarat</a>
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
</script>

@stop
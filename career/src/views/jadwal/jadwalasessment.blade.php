@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Jadwal Asessment
				<a href="javascript:void(0)" id="help_app" title="Form Untuk menambahkan Data Karyawan Yang Telah Memenuhi Syarat"><i class="fa fa-question-circle"></i></a>
            </header>
           <div class="panel-body">
				<div class="col-lg-12">
					{{Form::open(array('url' => 'career/jadwal/asessment',  'method'=>'post')) }}
					<section class="panel">
					  <div class="panel-body">
					  	<div class="form-group">
							<label for="Harus di isi">Nip</label>
							<input type="hidden" name="unit_id" class="form-control" value="{{$data->unit_staf_id}}">
					  		<input type="text" readonly name="nip" class="form-control" value="{{$data->nip}}"></input>
					  			@if($errors->first('unit_id'))
								<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
									{{ $errors->first('unit_id') }}
								</div>
								@endif
					  	</div>
					  	<div class="form-group">
							<label for="Harus di isi">Nama</label>
					  		<input type="text" readonly name="nama" class="form-control" value="{{$data->nama}}">
					  	</div>
					  	<div class="form-group">
							<label for="Harus di isi">Jabatan</label>
					  		<input type="text" readonly class="form-control" name="jabatan" value="{{$data->nama_lengkap}}">
					  	</div>
					  	<div class="form-group">
							<label for="Harus di isi">Pangkat Golongan</label>
					  		<input type="text" readonly class="form-control" value="{{$data->pangkat}} - {{$data->golongan}}">
					  	</div>
					  	<div class="form-group">
							<label for="Harus di isi">Kategori</label>
							 <select class="form-control" name="kategori">
								<option value="">------</option>
								<option value="eksternal">eksternal</option>
								<option value="internal">internal</option>
							</select>
							@if($errors->first('kategori'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('kategori') }}
										    </div>
										@endif	  		
					  	</div>
					  	<div class="form-group">
							<label for="Harus di isi">Tanggal mulai Asessment</label>
							<input type="text" readonly name="tglstart" class="form-control tglstart" >	
							@if($errors->first('tglstart'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('tglstart') }}
										    </div>
										@endif	  		
					  	</div>
					  		<div class="form-group">
					  		<label for="Harus di isi">Tanggal Asessment</label>
							<input type="text" readonly name="tglases" class="form-control tglases" >	
							@if($errors->first('tglases'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('tglases') }}
										    </div>
										@endif			  		
					  	</div>
					  	<div class="form-group">
					  		<label for="Harus di isi">Tanggal Selesai Asessment</label>
							<input type="text" readonly name="tglfinish" class="form-control tglfinish" >	
							@if($errors->first('tglfinish'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('tglfinish') }}
										    </div>
										@endif			  		
					  	</div>
					  	<div class="form-group">
					  		<label for="Harus di isi">Detail</label>
							<textarea name="detail" class="form-control" ></textarea>	
							@if($errors->first('detail'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('detail') }}
										    </div>
										@endif			  		
					  	</div>
					  	<button type="submit" class="btn btn-primary">Tambahkan Proses Promosi Jabatan</button>
					  </div>
					</section>
					{{Form::close()}}
				</div>
				</div>
			</div>
        </section>
    </div>
</div>

@stop

@section('customcss')
<link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
<link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
@stop

@section('customjs')
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script>
$("#menu_atur").addClass("active");
$("#menu_atur_at").addClass("active");
$("#menu_atur_at_kand").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});
$('.tglstart').datepicker({
    format: 'yyyy/mm/dd',
    startDate: '-3d'
})
$('.tglases').datepicker({
    format: 'yyyy/mm/dd',
    startDate: '-3d'
})
$('.tglfinish').datepicker({
    format: 'yyyy/mm/dd',
    startDate: '-3d'
})
$(".alert").alert()
</script>

@stop
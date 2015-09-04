@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Tambah Prasyarat Jabatan
				<a href="javascript:void(0)" id="help_app" title="Menu Ini Menambahkan Prasyarat Pada Eselon Jabatan"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
            	
				<div class="col-lg-12">
					<section class="panel">
					  <div class="panel-body">
					  		{{ Form::open(array('url' => 'career/kirim',  'method'=>'post')) }}
								  <div class="form-group">
								  	<label for="Harus di isi">Kelas Jabatan</label>
								  	<input type="text" disabled="disabled" class="form-control" id="kjabatan" name="nama_jab" placeholder="Jabatan" value="{{$eselon->jabatan}}">
									<input type="hidden" class="form-control" id="kjabatan" name="kel_jab" placeholder="Jabatan" value="{{$eselon->id}}">
									    
								  </div>
								  <div class="form-group">
									    <label for="exampleInputEmail1">Pangkat dan Golongan</label>
									    <br>
									        @if($errors->first('golongann'))
									    		<?php //dipakai untuk multiple aray[5][] 5 ?>
									    		<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    		{{ $errors->first('golongann') }}
										    	</div>
											@endif
									    	@foreach($dafgol as $gol)
											   <input type="checkbox" name="golongann[2][]" value="{{$gol->gol_id}}"/> {{$gol->pangkat}} - {{$gol->golongan}}<br />
											@endforeach  
										
								  </div>
								  <div class="form-group">
									    <label for="exampleInputEmail1">Pendidikan yang dipersyaratkan</label>
									    <br>
									        @if($errors->first('pendidikan'))
									    		<?php //dipakai untuk multiple aray[5][] 5 ?>
									    		<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    		{{ $errors->first('pendidikan') }}
										    	</div>
											@endif
									    	@foreach($jenjang as $jenja)
											   <input type="checkbox" name="pendidikan[5][]" value="{{$jenja->jenjang_id}}"/> {{$jenja->nama}}<br />
											@endforeach
								  </div>
								
								  		<button type="submit" class="btn btn-primary">Submit</button>
							{{ Form::close() }}
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
	$('input[name=kelasjabatan ]').autocomplete({
		source:'{{ url('career/ajaxkelasjab') }}',
		minLength:1,
		focus: function( event, ui ) {$( 'input[name=kelasjabatan ]' ).val( ui.item.value ); return false;},
		select: function( event, ui ) {
			$( 'input[name=kelasjabatan ]' ).val( ui.item.value );
			$( 'input[name=kel_jabatan ]' ).val( ui.item.data);
			return false;
		}
              });

	$('input[name=kJabatan ]').autocomplete({
		source:'{{ url('career/ajaxjab') }}',
		minLength:1,
		focus: function( event, ui ) {$( 'input[name=kJabatan ]').val( ui.item.value ); return false;},
		select: function( event, ui ) {
			$( 'input[name=kJabatan ]').val( ui.item.value );
			$( 'input[name=id_jabatan ]' ).val( ui.item.data );
			return false;
		}
              });
	  $(".alert").alert()
</script>
@stop
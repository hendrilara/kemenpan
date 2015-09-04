@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
				Edit Eselon Jabatan
				<a href="javascript:void(0)" id="help_app" title="Form Ubah Jabatan Pada Eselon Jabatan"><i class="fa fa-question-circle"></i></a>
            </header>
            <div class="panel-body">
            	
				<div class="col-lg-12">
					<section class="panel">
					  <div class="panel-body">
					  		{{ Form::open(array('url' => 'career/update',  'method'=>'post')) }}
					  		<input type="hidden" value='{{$asesment->id}}' name='id'></input>
								  <div class="form-group">
									    <label for="Harus di isi">Jabatan</label>
									    <select id="complete" class="form-control select" name="id_jabatan">
										 	<option value="">----</option>
										 	@foreach($dafunit as $dafunitt)
										 		<option value="{{$dafunitt->unit_staf_id}}" @if(isset($asesment->unit_staf_id) && $asesment->unit_staf_id==$dafunitt->unit_staf_id) selected="selected" @endif> {{$dafunitt->nama_lengkap}}</option>
										 	@endforeach
										</select>
									    @if($errors->first('id_jabatan'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('id_jabatan') }}
										    </div>
										@endif
								  </div>
								    <div class="form-group">
									    <label for="exampleInputEmail1">Kelas Jabatan</label>
									    <select id="autocomplete" class="form-control select1" name="kel_jabatan">
										 	<option value="">----</option>
										 	@foreach($eselon as $selo)
										 		<option value="{{$selo->id}}" @if(isset($selo->id) && $selo->id == $asesment->asesment_eselon_id) selected="selected" @endif> {{$selo->jabatan}}</option>
										 	@endforeach
										</select>	
										   @if($errors->first('kel_jabatan'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('kel_jabatan') }}
										    </div>
										@endif
								  </div>
								  <div class="form-group">
									    <label for="exampleInputEmail1">Unit</label>
									   <select class="form-control" name="unit">
									   	  <option value="">------</option>
										  <option value="SESMEN" @if(isset($asesment->unit)&&$asesment->unit==='SESMEN') selected="selected" @endif>SESMEN</option>
										  <option value="SDM" @if(isset($asesment->unit)&&$asesment->unit==='SDM') selected="selected" @endif>SDM</option>
										  <option value="YANLIK" @if(isset($asesment->unit)&&$asesment->unit==='YANLIK') selected="selected" @endif>YANLIK</option>
										  <option value="KLTL" @if(isset($asesment->unit)&&$asesment->unit==='KLTL') selected="selected" @endif>KLTL</option>
										  <option value="RBKUNWAS" @if(isset($asesment->unit)&&$asesment->unit==='RBKUNWAS') selected="selected" @endif>RBKUNWAS</option>
										</select>
								  </div>
								  @if($errors->first('unit'))
									    <div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a>
										    	{{ $errors->first('unit') }}
										    </div>
										@endif
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
<link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
@stop

@section('customjs')
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
<script>
$("#menu_atur").addClass("active");
$("#menu_atur_at").addClass("active");
$("#menu_atur_at_jab").addClass("active");
$(document).ready(function() {
	$( "#help_app" ).tooltip();
});

	$("#complete").select2();
	  $('.select').on("change", function(e){
//            var selectId = $(this).val();
            $('#orderForm').submit();
            e.preventDefault();
        });
	  $("#autocomplete").select2();
	  $('.select1').on("change", function(e){
//            var selectId = $(this).val();
            $('#orderForm').submit();
            e.preventDefault();
        });
	  $(".alert").alert()
</script>
@stop
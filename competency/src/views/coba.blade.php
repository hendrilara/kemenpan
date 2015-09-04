@section('content')
	<div class="modal-body">
                                {{ Form::open(array('url' => 'admin/diklat/diklat/proses', 'method'=>'POST')) }}
                                <input id="ta" name="ta" type="hidden"></input>
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Kompetensi:</label> 
                                   
                                    {{ $errors->first('ta') }}
                                </div> 

                                <div class="from-group">
                                    <label for="message-text" class="control-label">Nama Kompetensi:</label>
                                    <select id="mboh" class="form-control select">
                                        <option value="0">Pilih Kompetensi</option>
                                    </select>
                                </div>

                                <div class="from-group">
                                    <label for="message-text" class="control-label">Judul Diklat:</label>
                                    <select id="diklat" class="form-control select">
                                        <option value="0">Pilih Judul Diklat</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Deskripsi:</label>
                                    <textarea class="form-control" readonly name="deskripsi" id="deskripsi"></textarea>
                                    {{$errors->first('deskripsi')}}
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Sasaran/Tujuan:</label>
                                    <input type="text" class="form-control" name="sasaran" id="#">
                                    {{$errors->first('sasaran')}}
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Tanggal Mulai Pelaksanaan:</label>
                                    <input id="datepicker" type="text" name="tglmulai" class="form-control" >
                                    {{$errors->first('tglmulai')}}
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Tanggal Selesai Pelaksanaan:</label>
                                    <input id="tanggalanen" type="text" name="tglselesai" class="form-control" >
                                    {{$errors->first('tglselesai')}}
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Jumlah Hari Diklat:</label>
                                    <input type="text" name="jmlhari" class="form-control" >
                                    {{$errors->first('jmlhari')}}
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="control-label">Kuota Peserta:</label>
                                    <input type="text" name="kuota" class="form-control" id="#">
                                    {{$errors->first('kuota')}}
                                </div>

                                <div class="from-group">
                                    <label for="message-text" class="control-label">Anggaran Diklat:</label>
                                    RP. <input type="text" name="anggaran" class="form-control" id="#">
                                    {{$errors->first('anggaran')}}
                                </div>

                                <div class="form-group">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">simpan</button>
                                <button type="button" class="btn btn-primary">Cetak</button>
                            </div>
                            {{ Form::close() }}
                        </div>
@stop
@section('customcss')
    <link href="{{ asset('assets/select2/select2.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/select2/bootstrap3.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.css')}}"/>
     <link rel="stylesheet" href="/resources/demos/style.css">
@stop

@section('customjs')
    <script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

 <script type="text/javascript">
 $(function() {
    $("#datepicker").datepicker();
  });
</script>
  @stop
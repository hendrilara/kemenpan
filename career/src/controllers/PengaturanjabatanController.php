<?php namespace Meniqa\Career\Controllers;

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Eloquent;


use Meniqa\Career\Models\AsesmentEselon;
use Meniqa\Career\Models\AsesmentKelas;


	class PengaturanjabatanController extends BaseController{
		protected $layout = 'layouts.backend.admin';
			

		public function Jabatan(){
			$asesment=DB::table('asesment_kelas')
            ->join('asesment_eselon', 'asesment_kelas.asesment_eselon_id', '=', 'asesment_eselon.id')
            ->join('lpp_kemenpan_siasik.daf_unit_staf','asesment_kelas.unit_staf_id','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
            ->join('asesment_tipe', 'asesment_eselon.asesment_tipe_id','=','asesment_tipe.id')
            ->select('asesment_kelas.asesment_eselon_id','asesment_kelas.id','asesment_kelas.unit','asesment_eselon.jabatan','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','asesment_tipe.nama_tipe')
            ->OrderBy('asesment_tipe.nama_tipe','ASC')
            ->paginate('20');
			//$asesment = AsesmentKelas::take(10)->skip(5)->get();
			//$asesment=AsesmentEselon::with('AsesmentKelass')->paginate('20');
			//dd($asesment);
			//exit();
		
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Eselon dan Jabatan" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::assessment/PengaturanJabatan',compact('asesment'));
		}

		public function TambahJabatan(){
			$dafunit = DB::connection('siasik')
			->table('daf_unit_staf')
			->select('unit_staf_id','nama_lengkap')
			->get();

			$eselon = DB::table('asesment_eselon')
			->select('id','jabatan')
			->get();

			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Eselon dan Jabatan" => ""),
	            array("Tambah Eselon Jabatan" => "")
	        );
	        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::assessment/TambahJabatan', compact('dafunit','eselon'));
			//return View::make('assessment/TambahJabatan');
		}

		public function Proses(){
			$id_jab = Input::get('id_jabatan');
			$jab = Input::get('kJabatan');

			$rules = array(
				'id_jabatan' => 'required',
				'kel_jabatan' => 'required',
				'unit' => 'required'
				);
			$messages = array(
				'id_jabatan.required' => 'Jabatan Tidak Boleh Kosong',
				'kel_jabatan.required' => 'Kelas jabatan Tidak Boleh Kosong',
				'unit.required' => 'Unit Harus Disi'
				);

			$validasi = Validator::make(Input::all(), $rules, $messages);
			if($validasi->fails()){
					return Redirect::to('career/jabatan/tambah')
					->withErrors($validasi)
					->withInput();
					}else{
					$cek = AsesmentKelas::where('unit_staf_id','LIKE',"%$id_jab%");
					if(isset($cek)){
					Session::flash('message','data jabatan'.' '. $jab .' '.'sudah ada');
				    return Redirect::back()
				    ->withErrors($validasi)
					->withInput();
					}else{
					$proses = new AsesmentKelas;
					$proses->asesment_eselon_id = Input::get('kel_jabatan');
					$proses->unit_staf_id = Input::get('id_jabatan');
					$proses->unit = Input::get('unit');
					$proses->save();
					Session::flash('message','Berhasil Menambahkan Eselon Pada Jabatan');
				    return Redirect::to('career/jabatan');
				    }
					}
		}

		public function Ambil($id=""){
            $asesment= DB::table('asesment_kelas')
            ->join('asesment_eselon','asesment_eselon.id','=','asesment_kelas.asesment_eselon_id')
            ->join('lpp_kemenpan_siasik.daf_unit_staf','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id','=','asesment_kelas.unit_staf_id')
            ->select('asesment_kelas.id','asesment_kelas.asesment_eselon_id','asesment_eselon.jabatan', 'asesment_kelas.unit','asesment_kelas.unit_staf_id', 'lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap')
            ->where('asesment_kelas.id','=',$id)->first();

            $dafunit = DB::connection('siasik')
			->table('daf_unit_staf')
			->select('unit_staf_id','nama_lengkap')
			->get();

			$eselon = DB::table('asesment_eselon')
			->select('id','jabatan')
			->get();

            //$asesment = $query->result();
           $breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Eselon dan Jabatan" => ""),
	            array("Edit Eselon Jabatan" => "")
	        );

           // mengecek return $asesment[0]->id; jika menggukanan get() harus di foreach dulu
            // mengecek return $asesment->id; jika first() cuman satu yang di ambil

			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::assessment/ubahjabatan',compact('asesment','dafunit','eselon'));
		}

		public function Ubah(){
			$id = Input::get('id');
				$rules = array(
				'id_jabatan' => 'required',
				'kel_jabatan' => 'required',
				'unit' => 'required'
				);
			$messages = array(
				'id_jabatan.required' => 'Jabatan Tidak Boleh Kosong',
				'kel_jabatan.required' => 'Kelas jabatan Tidak Boleh Kosong',
				'unit.required' => 'Unit Harus Disi'
				);
			$validasi = Validator::make(Input::all(), $rules, $messages);
			if($validasi->fails()){
					return Redirect::back()
//					return Redirect::to('career/jabatan/ubah')
					->withErrors($validasi);

					}else{
					
					$proses = AsesmentKelas::find($id);
					$proses->asesment_eselon_id = Input::get('kel_jabatan');
					$proses->unit_staf_id = Input::get('id_jabatan');
					$proses->unit = Input::get('unit');
					$proses->save();
					Session::flash('message','Berhasil Ubah Data Eselon Pada Jabatan');
				    return Redirect::to('career/jabatan');
					}
		}

		public function Hapus($id){
			if(isset($id)):else: echo"data tidak ditemukan"; endif;
			$hapus = AsesmentKelas::find($id);
			$hapus->delete();
			Session::flash('message','Data Berhasil Di Hapus');
			return Redirect::to('career/jabatan');
		}

		public function Cari(){
			$golek = Input::get('cari');
			if(empty($golek)):  Session::flash('messagess','anda belum memasukkan keyword');return Redirect::to('career/jabatan'); endif;
			$asesment=DB::table('asesment_kelas')
            ->join('asesment_eselon', 'asesment_kelas.asesment_eselon_id', '=', 'asesment_eselon.id')
            ->join('lpp_kemenpan_siasik.daf_unit_staf','asesment_kelas.unit_staf_id','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
            ->join('asesment_tipe', 'asesment_eselon.asesment_tipe_id','=','asesment_tipe.id')
            ->select('asesment_kelas.id','asesment_kelas.unit','asesment_eselon.jabatan','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','asesment_tipe.nama_tipe')
            ->where('unit','LIKE',"%$golek%")
            ->orwhere('jabatan','LIKE',"%$golek%")
            ->orwhere('nama_lengkap','LIKE',"%$golek%")
            ->orwhere('jabatan','LIKE',"%$golek%")
            ->orwhere('nama_tipe','LIKE',"%$golek%")
            ->paginate('20');
			
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Prasyarat Jabatan" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::assessment/PengaturanJabatan',compact('asesment'));
		}
		
	}
?>
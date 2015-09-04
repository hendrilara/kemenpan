<?php namespace Meniqa\Career\Controllers;

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Eloquent;
use Illuminate\Support\Facades\Paginator;


use Meniqa\Career\Models\KandidatPromote;
use Meniqa\Career\Models\HeaderRekap;
use Meniqa\Career\Models\KandidatPromosiDaftar;
use Meniqa\Career\Models\ProfilingRekap;

	class KandidatPromosiController extends BaseController{
		protected $layout = 'layouts.backend.admin';

		public function KandidatPromote(){
			$dafunit = DB::table('lpp_kemenpan_siasik.daf_unit_staf')
			->join('asesment_kelas','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id','=','asesment_kelas.unit_staf_id')
			->select('asesment_kelas.unit_staf_id','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','lpp_kemenpan_siasik.daf_unit_staf.eselon_id')
			->get();
			$ambil = Input::get('cari');
			if (empty($ambil)) {
				$comment = "<div class='alert alert-danger'><a class='close' data-dismiss='alert'>&times;</a>Silahkan Anda Memasukkan Jabatan</div>";
				//Session::flash('messagess','Silahkan Anda Memasukkan Jabatan');
			}else{
				$unit = DB::select(
				DB::RAW("select count(asesment_prasyarat_jabatan.nilai) as nilai, asesment_kelas.id, asesment_tipe.nama_tipe, prestasi_kerja_rekap_penilaian.nilai_kompetensi, prestasi_kerja_rekap_penilaian.nilai_kinerja, lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap
			 	,lpp_kemenpan_siasik.master_pegawai.nama, asesment_eselon.jabatan,asesment_kelas.unit_staf_id,lpp_kemenpan_siasik.daf_gol.pangkat,lpp_kemenpan_siasik.daf_gol.golongan
			 	from asesment_kelas
			 	join lpp_kemenpan_siasik.daf_unit_staf on lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id = asesment_kelas.unit_staf_id 
			 	join lpp_kemenpan_siasik.daf_gol on lpp_kemenpan_siasik.daf_gol.gol_id = lpp_kemenpan_siasik.daf_unit_staf.eselon_id
				join asesment_eselon on asesment_eselon.id = asesment_kelas.asesment_eselon_id 
				join asesment_tipe on asesment_tipe.parent_id = asesment_eselon.asesment_tipe_id
				left join asesment_prasyarat_jabatan on asesment_prasyarat_jabatan.asesment_eselon_id = asesment_kelas.asesment_eselon_id
				join asesment_prasyarat on asesment_prasyarat.id = asesment_prasyarat_jabatan.asesment_prasyarat_id 
				join prestasi_kerja_rekap_penilaian on prestasi_kerja_rekap_penilaian.id_jabatan = asesment_kelas.unit_staf_id
				join lpp_kemenpan_siasik.master_pegawai on lpp_kemenpan_siasik.master_pegawai.nip = prestasi_kerja_rekap_penilaian.nip  
				where asesment_kelas.unit_staf_id = '$ambil' and prestasi_kerja_rekap_penilaian.nilai_kinerja >= 76 and 
				prestasi_kerja_rekap_penilaian.nilai_kompetensi >= 60"));
				foreach($unit as $un){
				if(empty($un) && empty($un->jabatan)){
					Session::flash('message','Maaf Data Eselon Jabatan Belum Ada di Database');
				}elseif(isset($un->parent_id) && $un->parent_id ==0){
					Session::flash('message','Maaf Data yang Anda Masukkan Eselon 1');
				}elseif(($un->nilai_kinerja <=76) && ($un->nilai_kompetensi <=60 )  ){
					Session::flash('message','Maaf Nilai Tidak memenuhi');
				}
			}
			
		} //endof if $ambil

		$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Kandidat Promosi Jabatan" => "")
	        );	
		$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
		$this->layout->content = View::make('career::kandidat/kandidatpromote',compact('dafunit','unit','comment'));
	}

		public function ProsesJadwal($id){
			$data = DB::table('prestasi_kerja_rekap_penilaian')
			->join('lpp_kemenpan_siasik.daf_unit_staf','prestasi_kerja_rekap_penilaian.id_jabatan','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
			->join('lpp_kemenpan_siasik.master_pegawai','prestasi_kerja_rekap_penilaian.nip','=','lpp_kemenpan_siasik.master_pegawai.nip')
			->join('lpp_kemenpan_siasik.daf_gol','lpp_kemenpan_siasik.daf_unit_staf.eselon_id','=','lpp_kemenpan_siasik.daf_gol.gol_id')
			->select('prestasi_kerja_rekap_penilaian.nip','prestasi_kerja_rekap_penilaian.id_jabatan','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id','lpp_kemenpan_siasik.master_pegawai.nama','lpp_kemenpan_siasik.daf_gol.pangkat','lpp_kemenpan_siasik.daf_gol.golongan')
			->where('lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id','=',$id)
			->first();

			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Tambah Kandidat Promosi" => "")
	        );
	        		
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::jadwal/jadwalasessment',compact('data'));
		}

		public function TambahJadwal(){

			$rules=array(
				'unit_id' => 'required',
				'kategori' =>'required',
				'tglstart' => 'required',
				'tglases' => 'required',
				'tglfinish' => 'required',
				'detail' => 'required'
			);
			$messages = array(
				'unit_id.required' => 'Nama Jabatan Harus Terisi',
				'kategori.required' => 'Kategori Harus Dipilih',
				'tglstart.required' => 'Tanggal Mulai Harus Terisi',
				'tglases.required' => 'Tanggal Asessment Harus Terisi',
				'tglfinish.required' => 'Tanggal Selesai Harus Terisi',
				'detail.required' => 'Detail Harus terisi'
				);
			$validasi = validator::make(Input::all(), $rules, $messages);
			if($validasi->fails()){
				return Redirect::back()
					->withErrors($validasi)
					->withInput();
		}else{
			$kat = Input::get('kategori');
			if($kat=='internal'){
				$aa = "in";
			}else{
				$aa = "ex";
			}
			DB::transaction(function($aa) use ($aa)
			{
			//asesment promosi
			$jadwal = KandidatPromote::create([
			'unit_staf_id' => Input::get('unit_id'),
			'tgl_awal' => Input::get('tglstart'),
			'tgl_asesment' => Input::get('tglases'),
			'tgl_selesai' => Input::get('tglfinish'),
			'detail' => Input::get('detail')
				]);
			//rekrutmen rekap header
			$rekap_header = HeaderRekap::create([
			'id_asesmen' => $jadwal->id,
			'kategori' => Input::get('kategori'),
			'nama' => Input::get('jabatan'),
			'tanggal_awal' => Input::get('tglstart'),
			'tanggal_akhir' => Input::get('tglfinish'),
			'deksripsi' => Input::get('detail')
				]);
			//asessment promosi daftar
			$daftar = KandidatPromosiDaftar::create([
			'asesment_promosi_id' => $jadwal->id,
			'nip' =>Input::get('nip'),
			'detail' => Input::get('detail')
				]);
			//rekrutment rekap profiling
			$profil = ProfilingRekap::create([
			'id_rekap' =>$rekap_header->id,
			'kategori' =>$aa,
			'nip' => $daftar->nip,
			'id_jabatan' =>$jadwal->unit_staf_id
				]);

				});

			Session::flash('message','Berhasil Menambahkan Jadwal Asessment');
			return Redirect::to('career/jadwal/lihat/asessment');

		}
		}
	}

?>
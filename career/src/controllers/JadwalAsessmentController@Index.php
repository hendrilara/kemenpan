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

	class JadwalAsessmentController extends BaseController{
		
		protected $layout = 'layouts.backend.admin';

		public function Index(){
			/*$data = DB::table('asesment_promosi')
			->join('lpp_kemenpan_siasik.daf_unit_staf','asesment_promosi.unit_staf_id','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
			->select('lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','asesment_promosi.id','asesment_promosi.unit_staf_id','asesment_promosi.tgl_awal','asesment_promosi.tgl_asesment','asesment_promosi.tgl_selesai','asesment_promosi.detail')
			->paginate('10');*/
			$tahun = DB::select(
				DB::RAW(" select year(tgl_selesai) from asesment_promosi
					"));
		$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Jadwal Asessment" => "")
	        );
	        		
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::jadwal/indexasessment',compact('tahun'));
			}

		public function HapusJadwal($id){
			DB::transaction(function() use ($id)
				{ 
					$header=DB::table('rekrutmen_rekap_header')->select('rekrutmen_rekap_header.id')->join('asesment_promosi','rekrutmen_rekap_header.id_asesmen','=','asesment_promosi.id')->where('rekrutmen_rekap_header.id_asesmen', '=', $id)->first();
				    DB::table('asesment_promosi')->delete($id);
				    DB::table('asesment_promosi_daftar')->join('asesment_promosi','asesment_promosi_daftar.asesment_promosi_id','=','asesment_promosi.id')->where('asesment_promosi_daftar.asesment_promosi_id', '=', $id)->delete();
				    
				   	DB::table('rekrutmen_rekap_profiling')
				    ->join('rekrutmen_rekap_header','rekrutmen_rekap_profiling.id_rekap','=','rekrutmen_rekap_header.id')
				    ->join('asesment_promosi','rekrutmen_rekap_header.id_asesmen','=','asesment_promosi.id')
				    ->where('rekrutmen_rekap_profiling.id_rekap', '=', $header->id)->delete();
				    DB::table('rekrutmen_rekap_header')->join('asesment_promosi','rekrutmen_rekap_header.id_asesmen','=','asesment_promosi.id')->where('rekrutmen_rekap_header.id_asesmen', '=', $id)->delete();
				});
			/*$hapus = new KandidatPromote;
			$hapus = KandidatPromote::find($id);
			$hapus->delete();*/
			Session::flash('message','Data Berhasil Di Hapus');
			return Redirect::to('career/jadwal/lihat/asessment');
		}

		public function Cari(){
			$th = Input::get('tahun');
			$data = DB::table('asesment_promosi')
			->join('lpp_kemenpan_siasik.daf_unit_staf','asesment_promosi.unit_staf_id','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
			->select('tgl_selesai','asesment_promosi.tgl_selesai','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','asesment_promosi.id','asesment_promosi.unit_staf_id','asesment_promosi.tgl_awal','asesment_promosi.tgl_asesment','asesment_promosi.tgl_selesai','asesment_promosi.detail')
			->whereyear('tgl_selesai','=',$th)
			->paginate('10');
			$tahun = DB::select(
				DB::RAW(" select year(tgl_selesai) from asesment_promosi
					"));
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Jadwal Asessment" => "")
	        );
	        		
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::jadwal/indexasessment',compact('data','tahun'));
		}
}
?>
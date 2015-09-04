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


use Meniqa\Career\Models\Prasyarat;

	class TalentPoolController extends BaseController{
		protected $layout = 'layouts.backend.admin';
		public function Talent(){
			$talent = DB::table('prestasi_kerja_rekap_penilaian')
			->join('lpp_kemenpan_siasik.master_pegawai','prestasi_kerja_rekap_penilaian.nip','=','lpp_kemenpan_siasik.master_pegawai.nip')
			->join('lpp_kemenpan_siasik.daf_unit_staf','prestasi_kerja_rekap_penilaian.id_jabatan','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
			->join('lpp_kemenpan_siasik.daf_gol','lpp_kemenpan_siasik.daf_unit_staf.eselon_id','=','lpp_kemenpan_siasik.daf_gol.gol_id')
			->select('lpp_kemenpan_siasik.master_pegawai.nama','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','lpp_kemenpan_siasik.daf_gol.pangkat','lpp_kemenpan_siasik.daf_gol.golongan','prestasi_kerja_rekap_penilaian.nilai_kinerja','prestasi_kerja_rekap_penilaian.nilai_kompetensi')
			->orderBy('nilai_kompetensi','DESC')
			->orderBy('nilai_kinerja','DESC')
			->paginate('10');
/*$array = array("hai","jon","dimana","ss","aa","bbb");
$ar = array("hii","jos","joy","ho","ki","ki");
$data = array();
foreach($array as $key=>$a){
	echo "<pre>";
	echo "<br>";
	print_r($key);
	print_r($ar[$key]);
}
exit();*/
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("TalentPool" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::talentpool',compact('talent'));

		}

		public function Cari(){
			$golek = Input::get('cari');
			$talent = DB::table('prestasi_kerja_rekap_penilaian')
				->join('lpp_kemenpan_siasik.master_pegawai','prestasi_kerja_rekap_penilaian.nip','=','lpp_kemenpan_siasik.master_pegawai.nip')
				->join('lpp_kemenpan_siasik.daf_unit_staf','prestasi_kerja_rekap_penilaian.id_jabatan','=','lpp_kemenpan_siasik.daf_unit_staf.unit_staf_id')
				->join('lpp_kemenpan_siasik.daf_gol','lpp_kemenpan_siasik.daf_unit_staf.eselon_id','=','lpp_kemenpan_siasik.daf_gol.gol_id')
				->select('lpp_kemenpan_siasik.master_pegawai.nama','lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','lpp_kemenpan_siasik.daf_gol.pangkat','lpp_kemenpan_siasik.daf_gol.golongan','prestasi_kerja_rekap_penilaian.nilai_kinerja','prestasi_kerja_rekap_penilaian.nilai_kompetensi')
				->where('lpp_kemenpan_siasik.daf_unit_staf.nama_lengkap','LIKE',"%$golek%")
				->orwhere('lpp_kemenpan_siasik.master_pegawai.nama','LIKE',"%$golek%")
				->orderBy('nilai_kompetensi','')
				->orderBy('nilai_kinerja','DESC')
				->paginate('10');
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("TalentPool" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::talentpool',compact('talent'));
		} 
	}

?>
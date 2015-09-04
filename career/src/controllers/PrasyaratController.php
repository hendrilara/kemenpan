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


	class PrasyaratController extends BaseController{
		protected $layout = 'layouts.backend.admin';

		public function Prasyarat(){
			$results=DB::table('asesment_eselon')
			->leftjoin('asesment_prasyarat_jabatan', 'asesment_eselon.id', '=', 'asesment_prasyarat_jabatan.asesment_eselon_id')
           // ->join('asesment_prasyarat', 'asesment_prasyarat_jabatan.asesment_prasyarat_id','=','asesment_prasyarat.id')
			->select(DB::raw('count(nilai) as nilai, asesment_eselon.jabatan, asesment_eselon.id'))
			->groupBy('asesment_eselon.id')
			->orderBy('nilai','DESC')
			->orderBy('asesment_eselon.id','ASC')
			->paginate('10');
			
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Prasyarat Jabatan" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::prasyarat/view',compact('results' ));
		}

		public function TambahPrasyarat($id){
			$eselon= DB::table('asesment_eselon')
			//->join('asesment_tipe', 'asesment_eselon.asesment_tipe_id','=','asesment_tipe.id')
			->where('asesment_eselon.id','=',$id)
			->first();
			$dafgol= DB::table('lpp_kemenpan_siasik.daf_gol')->orderBy('lpp_kemenpan_siasik.daf_gol.gol_id','DESC')->get();
			$jenjang= DB::table('lpp_kemenpan_siasik.jenjang_pendidikan')->orderBy('lpp_kemenpan_siasik.jenjang_pendidikan.jenjang_id','ASC')->get();
			$dafunit = DB::table('asesment_prasyarat')->get();
			$riwjab = DB::table('lpp_kemenpan_siasik.riw_jab_struk')->get();
			/*echo "<pre>";
			print_r($eselon);
			exit();*/
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Prasyarat Jabatan" => ""),
	            array("Tambah Prasyarat Jabatan" => "")
	        );
	        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::prasyarat/tambah', compact('eselon', 'dafunit', 'jenjang', 'dafgol', 'riwjab'));
			//return View::make('assessment/TambahJabatan');
		}

		public function Kirim(){
			
			$rules=array(
				'golongann' => 'required',
				'pendidikan' => 'required'
			);
			$messages = array(
				'golongann.required' => 'pangkat dan Golongan Harus Terpilih',
				'pendidikan.required' => 'Jenjang Pendidikan Harus Terpilih '
				);
			$validasi = validator::make(Input::all(), $rules, $messages);
			if($validasi->fails()){
				return Redirect::back()
					->withErrors($validasi)
					->withInput();
			}else{
			$data = Input::get();
			$golong = array_keys($data['golongann']);
			$datagolongan = array_values($data['golongann']);
			$prasyarat = array_keys($data['pendidikan']);//mengecek key dari array kunci lima -> pendidikan[5][]
			$datanilai = array_values($data['pendidikan']);//mengambil data value
			foreach($datanilai['0'] as $a){
				//print_r(array_keys($data['pendidikan']));
				//print_r(array_values($data['pendidikan']));
				/*$bobok[] = array(
					'asesment_prasyarat_id'=>input::get('kel_jab'),
					'nilai'=>$a,
					'asesment_prasyarat_id'=>$prasyarat['0']
					);*/
				$proses = new Prasyarat;
				$proses->asesment_eselon_id=Input::get('kel_jab');
				$proses->asesment_prasyarat_id=$prasyarat['0'];
				$proses->nilai = $a;
				$proses->save();
			}

			foreach($datagolongan['0'] as $b){
				$proses = new Prasyarat;
				$proses->asesment_eselon_id=Input::get('kel_jab');
				$proses->asesment_prasyarat_id=$golong['0'];
				$proses->nilai = $b;
				$proses->save();
			}
					
					Session::flash('message','Berhasil Menambahkan Prasyarat Jabatan');
				    return Redirect::to('career/prasyarat');
			}
		}

		public function Cari(){
			$golek = Input::get('cari');
			if(empty($golek)):  Session::flash('messagess','anda belum memasukkan keyword');return Redirect::to('career/prasyarat'); endif;
            $results=DB::table('asesment_eselon')
			->leftjoin('asesment_prasyarat_jabatan', 'asesment_eselon.id', '=', 'asesment_prasyarat_jabatan.asesment_eselon_id')
           // ->join('asesment_prasyarat', 'asesment_prasyarat_jabatan.asesment_prasyarat_id','=','asesment_prasyarat.id')
			->select(DB::raw('count(nilai) as nilai, asesment_eselon.jabatan, asesment_eselon.id'))
			->where('asesment_eselon.jabatan','LIKE',"%$golek%")
			->groupBy('asesment_eselon.id')
			->orderBy('nilai','DESC')
			->orderBy('asesment_eselon.id','ASC')
			->paginate('10');

			
			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Prasyarat Jabatan" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::prasyarat/view',compact('results'));
		}


		public function ProsesHapus($id){
			if(isset($id)):else: echo"data tidak ditemukan"; endif;
			$ambil = DB::table('asesment_prasyarat_jabatan')
			->where('asesment_eselon_id','=',$id)
			->select('id')
			->get();
			//$del = $hapus->HapusEselon($id, $ambil);
			$key = array_keys($ambil);
			$value = array_values($ambil);
			$js = json_decode(json_encode ($value), true); //convert dari stdclass object to array
			foreach ($js as $val) {
				$hapuss = DB::table('asesment_prasyarat_jabatan')->where('id', $val['id'])->delete();
			}
			Session::flash('message','Data Berhasil Di Hapus');
			return Redirect::to('career/prasyarat');
		}

		public function Preview($id){
			$data = DB::table('asesment_prasyarat_jabatan')
			->join('asesment_eselon','asesment_prasyarat_jabatan.asesment_eselon_id','=','asesment_eselon.id')
			->where('asesment_prasyarat_jabatan.asesment_eselon_id','=',$id)
			->first();

			$jnjang = DB::table('asesment_prasyarat_jabatan')
			->join('lpp_kemenpan_siasik.jenjang_pendidikan','asesment_prasyarat_jabatan.nilai','=','lpp_kemenpan_siasik.jenjang_pendidikan.jenjang_id')
			->where('asesment_prasyarat_jabatan.asesment_eselon_id','=',$id)
			->where('asesment_prasyarat_jabatan.asesment_prasyarat_id','=',5)
			->get();
			
			$gol = DB::table('asesment_prasyarat_jabatan')
			->join('lpp_kemenpan_siasik.daf_gol','asesment_prasyarat_jabatan.nilai','=','lpp_kemenpan_siasik.daf_gol.gol_id')
			->where('asesment_prasyarat_jabatan.asesment_eselon_id','=',$id)
			->where('asesment_prasyarat_jabatan.asesment_prasyarat_id','=',2)
			->get();

			$breadcrumbs = array(
	            array("Assessment Internal" => "javascript:void(0)" ),
	            array("Pengaturan" => ""),
	            array("Prasyarat Jabatan" => ""),
	            array("Preview Prasyarat Jabatan" => "")
	        );	
			$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));	
			$this->layout->content = View::make('career::prasyarat/preview',compact('data','jnjang','gol'));
		}
}
?>		
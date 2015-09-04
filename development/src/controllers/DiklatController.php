<?php namespace Meniqa\Development\Controllers;


use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use Meniqa\Competency\Models\PreoritasDiklat;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnit;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;
use Meniqa\Competency\Models\CompetencyRecapIndividuals;

class DiklatController extends BaseController {

    protected $competencyData = false;
    protected $layout = 'layouts.backend.main';

    function __construct(){
        //get competency schedule active
        $competencyActive = Competency::where('status', '=', 'active')->first();
        if ($competencyActive->count()){
            $this->competencyData = $competencyActive;
        }else{
            $this->layout->content = View::make('competency::test.forbidden');
        }
    }

    public function getIndex(){

    	 set_time_limit(0);
         $user = Auth::user();

        $breadcrumbs = array(
               array('Kompetensi' => ""),
               array('Realiasi'   => ""),
               array('Diklat'     => ""),
               );

        $prioritas = PreoritasDiklat::all();

        //ambil jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

      // return $riwJabatan;

        //ambil detail user
        $masterPegawai = MasterPegawai::getDetailbyDate($this->competencyData->date_start, $user->nip);

        if($riwJabatan != false){
            $profileSoft = CompetencyProfile::getProfilebyJabatan($riwJabatan->unit_staf_id, 1)->get();
            $profileBusiness = CompetencyProfile::getProfilebyJabatan($riwJabatan->unit_staf_id, 2)->get();


            $competencyType = CompetencyType::all();
            $data = array();
            foreach ($competencyType as $rowType){
                $profile = CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $rowType->id);

                $data[] = array(
                    'type' => array(
                        'id' => $rowType->id,
                        'name' => $rowType->name,
                    ),
                    'profile' => $profile,
                );
            }
          //  $db = DB::table('db_pegawai.master_pegawai')->get();
            //return $db;

            //ambil data recap individual

            $preoritask = DB::table('competency_recap_individuals')
                   ->join('competency_recaps', 'competency_recap_individuals.competency_recap_id', '=', 'competency_recaps.id')
                   ->join('competency_dictionaries', 'competency_recap_individuals.competency_dictionary_id', '=', 'competency_dictionaries.id')
                   ->join('db_pegawai.master_pegawai', 'db_pegawai.master_pegawai.nip', '=', 'competency_recaps.user_nip')
                   ->join('db_pegawai.daf_unit_staf', 'db_pegawai.daf_unit_staf.unit_staf_id', '=', 'competency_recaps.occupation_id')
                   ->select(db::RAW('round(min(competency_recap_individuals.gap),2) as gap, count(competency_recaps.user_nip) as nip'),'competency_recap_individuals.rcl', 'competency_recap_individuals.itj', 'competency_recap_individuals.ccl', 'competency_recap_individuals.gap', 'competency_recaps.id', 'db_pegawai.master_pegawai.nip', 'db_pegawai.daf_unit_staf.nama_lengkap', 'competency_dictionaries.id')
                   ->orderBy('rcl', 'asc')
                   ->orderBy('itj', 'desc')
                   ->groupBy('competency_dictionary_id')
                   ->paginate(8);

                    

        
            $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
            $this->layout->content = View::make('development::useridentificationdiklat.index', compact('data', 'masterPegawai', 'deputi', 'unit', 'prioritas', 'preoritask'));
        }
    }
}

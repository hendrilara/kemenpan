<?php namespace Meniqa\Development\Controllers;

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnit;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;
use Meniqa\Competency\Models\DiklatEvaluasi;

class UserRealisasidiklatController extends BaseController {

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

    	$breadcrumbs = array(
    		   array('Kompetensi' => ""),
    		   array('Realiasi'   => ""),
    		   array('Diklat'     => ""),
    		   );

        $diklat = DiklatEvaluasi::all();
        $page = DiklatEvaluasi::paginate(5);

        set_time_limit(0);
         $user = Auth::user();


        //ambil jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

        //return $riwJabatan;

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

        //return $data;
            $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
            $this->layout->content = View::make('development::userrealisasidiklat.index', compact('data', 'masterPegawai', 'diklat', 'page'));
        }
    }

    	//$this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
       // $this->layout->content = View::make('development::userrealisasidiklat.index');
   // }


    public function getEva(){
        $competency = Competency::all();
        $competencyAll = CompetencyType::all();

        return $competencyAll;
        
         $this->layout->content = View::make('development::userrealisasidiklat.index', compact('data', 'masterPegawai'));
    }
}
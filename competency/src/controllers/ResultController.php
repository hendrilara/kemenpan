<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 1/26/15
 * Time: 11:05 AM
 */

use BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyRecap;
use Meniqa\Competency\Models\CompetencyRecapIndividuals;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;
use Symfony\Component\HttpFoundation\Request;

class ResultController extends BaseController {

    protected $layout = 'layouts.backend.main';

    function __construct(){

    }

    public function getIndex() {
        $competency = Competency::all();
        $this->layout->content = View::make('competency::result.index', compact('competency'));
    }

    public function postIndex(){
        $nip = Auth::user()->nip;
        $competency = Competency::all();
        $recap = CompetencyRecap::with('competency')->where('competency_id', '=', Input::get('competency_id'))->where('user_nip', '=', $nip)->first();
        $competencyType = CompetencyType::all();

        $masterPegawai = MasterPegawai::getDetailbyDate($recap->competency->date_start, $nip);

        foreach ($competencyType as $rowCT){
            $profiles = CompetencyProfile::getProfilebyRecapType($recap->user_nip, $rowCT->id);
            $result[] = array(
                'name' => $rowCT->name,
                'data' => $profiles,
            );
        }
//        return $result;

        $this->layout->content = View::make('competency::result.index', compact('competency', 'recap', 'result', 'masterPegawai'));
    }
}
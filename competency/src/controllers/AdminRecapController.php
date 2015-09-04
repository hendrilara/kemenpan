<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 1/5/15
 * Time: 10:49 PM
 */

use BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\CompetencyRecap;
use Meniqa\Competency\Models\CompetencyRecapIndividuals;
use Meniqa\Competency\Models\CompetencyTest;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;
use PDF;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;

class AdminRecapController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    public function getIndex(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Rekapitulasi Kompetensi" => ""),
        );

        $competency = Competency::getActive();
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminRecap.index', compact('competency'));
    }

    public function postIndex(){
//        return Input::all();
        $competency = Competency::getActive();
        $totalCompetency = 0;
        $totalValue = 0;
        if(count($competency) > 0){
            //list recap
            $listRecap = CompetencyRecap::getlistAll($competency->id);

            foreach($listRecap as $recap){
                //clean recap individual
                DB::table('competency_recap_individuals')->where('competency_recap_id', $recap->id)->delete();

                //get profile
                $sql = "SELECT c.competency_dictionary_id,c.rcl,c.itj,b.user_nip,a.level,d.value FROM competency_tests a, competency_dictionary_levels d, competency_recaps b RIGHT JOIN competency_profiles c on c.jabatan_id=b.occupation_id WHERE a.level=d.id AND a.competency_recap_id=b.id AND a.competency_dictionary_id=c.competency_dictionary_id AND b.competency_id=".$competency->id." and b.id=".$recap->id."";
                $arr = DB::select(DB::raw($sql));
                $arr = CompetencyProfile::getProfilefromRecapNip($recap->user_nip);

                $total = 0;
                foreach($arr as $row){
                    $test = CompetencyTest::getAvgTest($row->competency_dictionary_id, $recap->user_nip);

                    $recapInv = new CompetencyRecapIndividuals();
                    $recapInv->competency_recap_id = $recap->id;
                    $recapInv->competency_dictionary_id = $row->competency_dictionary_id;
                    $recapInv->rcl = $row->rcl;
                    $recapInv->itj = $row->itj;
                    $recapInv->ccl = $test->lvl;
                    $recapInv->gap = $test->lvl - $row->rcl;
                    $recapInv->priority = ($test->lvl - $row->rcl)*$row->itj;

                    $recapInv->save();
                    if($recapInv->gap >= 0)
                        $total = $total+1;
                }

                $updateRecap = CompetencyRecap::find($recap->id);
                if ($total == 0) :
                    $updateRecap->total = 0;
                else :
                    $updateRecap->total = $total/count($arr)*100;
                endif;

                $updateRecap->save();

                $totalCompetency = $totalCompetency + count($arr);
                $totalValue = $totalValue + $total;
            }

            //update Competency
            $updateCompetency = Competency::find($competency->id);
            if ($totalValue == 0):
                $updateCompetency->value = 0;
            else:
                $updateCompetency->value = $totalValue/$totalCompetency*100;
            endif;

            $updateCompetency->save();

            return Redirect::to('admin/competency/recap/result');
        }
        else{
            dd('fatal error');
        }
    }

    public function getResult(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Hasil Kompetensi" => ""),
        );
        $competencyAll = Competency::all();

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminRecap.result', compact('competencyAll'));
    }

    public function postResult(){
//        return Input::all();
        $competencyAll = Competency::all();
        $competency = Competency::find(Input::get('competency'));
        $recap = CompetencyRecap::with('pegawai', 'jabatan')->where('competency_id', $competency->id)->get();


        $this->layout->content = View::make('competency::adminRecap.result', compact('competencyAll', 'competency', 'recap'));
    }
}
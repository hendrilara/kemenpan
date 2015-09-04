<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/4/14
 * Time: 4:30 PM
 */

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnit;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

class ProfileController extends BaseController {

    protected $layout = 'layouts.backend.main';
    protected $competencyData = false;

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
            array("Kompetensi" => ""),
            array("Profil Kompetensi" => ""),
        );

        set_time_limit(0);
        $user = Auth::user();

        //get jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

        //get user detail
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

//            return $data;
            $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
            $this->layout->content = View::make('competency::profile.index', compact('data', 'masterPegawai'));
        }
    }

    public function import() {

        $this->layout->content = View::make('competency::profile.import');
    }

    public function doImport() {
        if (Input::hasFile('excel')){
            $profiles = Excel::load(Input::file('excel'), function($reader) {

            })->get();
//            return $profiles;

            if (count($profiles) > 0){
                foreach ($profiles as $profile) {
                    if (is_null($profile->rcl)){
                        echo $profile->id_profile."<br/>";
                        $rcl = 0;
                    }else{
                        $rcl = $profile->rcl;
                    }
                    if (is_null($profile->itj)){
                        echo $profile->id_profile."<br/>";
                        $itj = 0;
                    }else {
                        $itj = $profile->itj;
                    }
                    $competencyProfile = new CompetencyProfile;
                    $competencyProfile->competency_id = 1;
                    $competencyProfile->struktural_id = $profile->id_struk;
                    $competencyProfile->fungsional_id = $profile->id_fung;
                    $competencyProfile->golongan_id = $profile->id_gol;
                    $competencyProfile->jabatan_id = $profile->id_unit;
                    $competencyProfile->competency_dictionary_id = $profile->id_competency_dictionary;
                    $competencyProfile->rcl = $rcl;
                    $competencyProfile->itj = $itj;

                    $competencyProfile->save();
                }
            }
//            return $profiles;

        }else {
            return Input::all();
        }
    }

    public function index() {

        $units = DafUnitStaff::all();

        if (Request::isMethod('post'))
        {

            // create the validation rules ------------------------
            $rules = array(
                'unit' => 'required',
            );

            // validate against the inputs from our form
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {

                // get the error messages from the validator
                $messages = $validator->messages();

                // redirect our user back to the form with the errors from the validator
                return Redirect::back()->withErrors($messages);

            }else{
                $unit = DafUnitStaff::where('unit_staf_id', Input::get('unit'))->first();

                $softProfiles = CompetencyProfile::with('competencyDictionary')
                    ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
                    ->where('competency_dictionaries.type_id', '=', '1')
                    ->where('jabatan_id', '=', Input::get('unit'))
                    ->groupBy('competency_dictionary_id')
                    ->get();
                $hardProfiles = CompetencyProfile::with('competencyDictionary')
                    ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
                    ->where('competency_dictionaries.type_id', '=', '2')
                    ->where('jabatan_id', '=', Input::get('unit'))
                    ->groupBy('competency_dictionary_id')
                    ->get();
//                return $profiles;

                $this->layout->content = View::make('competency::profile.postindex', compact('units', 'unit', 'softProfiles', 'hardProfiles'));
            }
        }else {
            $this->layout->content = View::make('competency::profile.index', compact('units'));
        }


    }
}
<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 1/3/15
 * Time: 7:31 AM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PDF;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;

class AdminProfileController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    protected $rules = array(
        'competency_id' => 'required|integer',
        'jabatan_id' => 'required',
        'competency_dictionary_id' =>'required',
        'rcl' => 'required',
        'itj' => 'required'
    );

    public function getIndex(){
        $dataScheduleActive = Competency::where('status', '=', 'active')->first();
        $dataJabatan = DafUnitStaff::where('aktif_id', '=', 1)->get();

        $this->layout->content = View::make('competency::adminProfile.index', compact('dataScheduleActive', 'dataJabatan'));
    }

    public function getMatriksjabatan(){
        //q1 => jabatan_id
        $dataScheduleActive = Competency::where('status', '=', 'active')->first();
        $dataJabatan = DafUnitStaff::where('aktif_id', '=', 1)->get();

        $dataProfile = null;
        if(Input::has('q1'))
        {
            $dataProfile = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.competencyType')->where('competency_id', '=', $dataScheduleActive->id)->where('jabatan_id', '=', Input::get('q1'))->get();
//            return $dataProfile;
        }

        $this->layout->content = View::make('competency::adminProfile.matriksJabatan', compact('dataScheduleActive', 'dataJabatan', 'dataProfile'));
    }

    public function getMatrikskompetensi(){
        //q1 => kompetensi_id

        $dataScheduleActive = Competency::where('status', '=', 'active')->first();
        $dataCompetency = CompetencyDictionary::all();

        $dataProfile = null;
        if(Input::has('q1'))
        {
            $dataProfile = CompetencyProfile::with('jabatan')->where('competency_id', '=', $dataScheduleActive->id)->where('competency_dictionary_id', '=', Input::get('q1'))->get();
//            return $dataProfile;
        }

        $this->layout->content = View::make('competency::adminProfile.matriksKompetensi', compact('dataScheduleActive', 'dataCompetency', 'dataProfile'));
    }

    public function getDownloadmatriksjabatan($id){
        $dataScheduleActive = Competency::where('status', '=', 'active')->first();
        $dataProfile = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.competencyType')->where('competency_id', '=', $dataScheduleActive->id)->where('jabatan_id', '=', $id)->get();

        $html = View::make('competency.adminProfile.downloadMatriksjabatan', compact('dataProfile', 'dataScheduleActive'));
        return PDF::load($html, 'A4', 'portrait')->download('hard competency');
    }

    public function getOfflinetest(){
        //q1 => jabatan_id
        $dataScheduleActive = Competency::where('status', '=', 'active')->first();
        $dataJabatan = DafUnitStaff::where('aktif_id', '=', 1)->get();

        $dataProfile = null;
        if(Input::has('q1'))
        {
            $jabatanTerpilih = DafUnitStaff::where('unit_staf_id', Input::get('q1'))->first();
            $dataProfile = CompetencyProfile::with('competencyDictionary.competencyType', 'competencyDictionary.level')->where('competency_id', '=', $dataScheduleActive->id)->where('jabatan_id', '=', Input::get('q1'))->get();
//            return $jabatanTerpilih;
            $html = View::make('competency::adminProfile.downloadoffflinetest', compact('dataProfile', 'jabatanTerpilih'));
            return PDF::load($html, 'A4', 'portrait')->download('offline test competency');

        }else{
            $this->layout->content = View::make('competency::adminProfile.offlineTest', compact('dataScheduleActive', 'dataJabatan'));
        }

    }
}
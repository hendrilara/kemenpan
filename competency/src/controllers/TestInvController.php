<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/3/14
 * Time: 12:29 PM
 */

use BaseController;
use Illuminate\Support\Facades\DB;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyDictionaryLevel;
use Meniqa\Competency\Models\CompetencyHistoryUser;
use Meniqa\Competency\Models\CompetencyPeers;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyTest;
use Meniqa\Competency\Models\CompetencyRecap;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;
use Meniqa\Models\CompetencyType;

class TestInvController extends BaseController {

    protected $competencyData = false;

    protected $layout = 'layouts.backend.main';

    function __construct(){
        //get competency schedule active
        $this->competencyData = Competency::getActive();
    }

    public function checkActive(){
        switch (Competency::checkActive()) {
            case false:
                $title = "akses terbatas";
                $info = "halaman tidak dapat diakses";
                $detail = "jadwal kompetensi aktif tidak dapat ditemukan dalam database";
                $this->layout->content = View::make('layouts.forbidden', compact('info', 'title', 'detail'));
                return false;
                break;
            case 200:
                $title = "akses terbatas";
                $info = "halaman tidak dapat diakses";
                $detail = "kompetensi akan dibuka pada tanggal ".date("d M Y", strtotime($this->competencyData->date_start));
                $this->layout->content = View::make('layouts.time', compact('info', 'title', 'detail'));
                return false;
                break;
            case 300:
                $title = "akses terbatas";
                $info = "halaman tidak dapat diakses";
                $detail = "kompetensi telah ditutup pada tanggal ".date("d M Y", strtotime($this->competencyData->date_end));
                $this->layout->content = View::make('layouts.time', compact('info', 'title', 'detail'));
                return false;
                break;
            default:
                return true;
        }
    }

    public function getIndex() {
        $breadcrumbs = array(
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Diri Sendiri" => ""),
        );

        if ($this->checkActive() == true){
            $listData = CompetencyType::paginate(10);
            $competencyData = $this->competencyData;
            $user = Auth::user();

            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

            $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
            $this->layout->content = View::make('competency::testInv.index', compact('listData', 'competencyData', 'riwJabatan', 'user'));
        }
    }

    public function getType($typeId){
        $breadcrumbs = array(
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Diri Sendiri" => ""),
        );

        if ($this->checkActive() == true){
            set_time_limit(0);
            $user = Auth::user();

            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

            if($riwJabatan != false){
                $type = CompetencyType::find($typeId);
                $profile = CompetencyProfile::getTestInv($user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $typeId);
                $totalProfile = count(CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $typeId));
                $checkProfile = count(CompetencyProfile::checkTestInv($user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $typeId));

                $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
                $this->layout->content = View::make('competency::testInv.type', compact('profile', 'type', 'totalProfile', 'checkProfile'));
            }
        }
    }

    public function postType($typeId){
        if ($this->checkActive() == true){
            $userNip = Auth::user()->nip;
            // cek memiliki recap_id atau enggak
            $recap = CompetencyRecap::where('competency_id', '=', $this->competencyData->id)
                ->where('user_nip', '=', $userNip)
                ->first();

            if (is_null($recap)){
                //get jabatan
                $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userNip);

                $recap = new CompetencyRecap;
                $recap->competency_id = $this->competencyData->id;
                $recap->user_nip = $userNip;
                $recap->occupation_id = $riwJabatan->unit_staf_id;

                $recap->save();
            }

            //simpan ke dalam database
            $test = new CompetencyTest;
            $test->competency_id = $this->competencyData->id;
            $test->competency_recap_id = $recap->id;
            $test->competency_dictionary_id = Input::get('compId');
            $test->user_id = $userNip;
            $test->rater_id = $userNip;
            $test->level = Input::get('level');
            $test->evidence = Input::get('evidence');


            if($test->save()){
                return Redirect::to('competency/test/inv/type/'.$typeId.'');
            }
        }
    }

    public function action($typeId, $step = 1){

        $page= $step-1;

        if (Request::isMethod('post'))
        {
            //cek
            // create the validation rules ------------------------
            $rules = array(
                'level'     => 'required',
                'evidence'  => 'required',
            );

            // create custom validation messages ------------------
            $messages = array(
                'required' => 'form :attribute wajib diisi.',
            );

            $validator = Validator::make(Input::all(), $rules, $messages);

            if ($validator->fails()) {

            }else {
                $userNip = Auth::user()->nip;
                $userId = Auth::user()->id;
                // cek memiliki recap_id atau enggak
                $recap = CompetencyRecap::where('competency_id', '=', $this->competencyId)
                    ->where('user_id', '=', $userId)->where('user_nip', '=', $userNip)
                    ->first();

                if (is_null($recap)){
                    $recap = new CompetencyRecap;
                    $recap->competency_id = $this->competencyId;
                    $recap->user_id = $userId;
                    $recap->user_nip = $userNip;
                    $recap->occupation_id = '';

                    $recap->save();
                }

                //simpan ke dalam database
                $test = new CompetencyTest;
                $test->competency_id = $this->competencyId;
                $test->competency_recap_id = $recap->id;
                $test->competency_dictionary_id = Input::get('compId');
                $test->user_id = $userId;
                $test->rater_id = $userId;
                $test->level = Input::get('level');
                $test->evidence = Input::get('evidence');


                if($test->save()){
                    $newStep = $step+1;
                    return Redirect::to('competency/test/inv/'.$typeId.'/'.$newStep.'');
                }
            }

        }else{

            //data dari session
            $nip = Auth::user()->nip;

            //cek data master golongan
            $userData = CompetencyHistoryUser::where('nip', $nip)->where('competency_id', $this->competencyId)->first();
            $jabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $nip);

            //getProfile
            $profiles = CompetencyProfile::getProfilebyJabatan($jabatan->unit_staf_id, $typeId)
                ->take(1)
                ->skip($page)
                ->first();


//            //jika ada fung_id maka tidak menggunakan struk_id
//            if($userData->fung_id != 0){
//                //get profile
//                $profiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                    ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                    ->where('competency_dictionaries.type_id', '=', $typeId)
//                    ->where('struktural_id', '=', $userData->struk_id)
//                    ->where('jabatan_id', '=', $userData->unit_id)
//                    ->groupBy('competency_dictionary_id')
//                    ->take(1)
//                    ->skip($page)
//                    ->first();
//            }else {
//                //get profile
//                $profiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                    ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                    ->where('competency_dictionaries.type_id', '=', $typeId)
//                    ->where('fungsional_id', '=', $userData->fung_id)
//                    ->where('jabatan_id', '=', $userData->unit_id)
//                    ->groupBy('competency_dictionary_id')
//                    ->take(1)
//                    ->skip($page)
//                    ->first();
//            }

            $this->layout->content = View::make('competency::test.individu', compact('profiles'));
        }
    }

    public function checkTest(){
        //data dari session
        $userNip = Auth::user()->nip;
        $userId = Auth::user()->id;

        //cek data master golongan
        $userData = CompetencyHistoryUser::where('nip', $userNip)->where('competency_id', $this->competencyId)->first();
        $jabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userNip);

        //getProfile
        $softProfiles = CompetencyProfile::getProfilebyJabatan($jabatan->unit_staf_id, 1)->get();
        $hardProfiles = CompetencyProfile::getProfilebyJabatan($jabatan->unit_staf_id, 2)->get();

//        //jika ada fung_id maka tidak menggunakan struk_id
//        if($userData->fung_id != 0){
//            //get profile
//            $softProfiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                ->where('competency_dictionaries.type_id', '=', '1')
//                ->where('struktural_id', '=', $userData->struk_id)
//                ->where('jabatan_id', '=', $userData->unit_id)
//                ->groupBy('competency_dictionary_id')
//                ->get();
//
//            $hardProfiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                ->where('competency_dictionaries.type_id', '=', '2')
//                ->where('struktural_id', '=', $userData->struk_id)
//                ->where('jabatan_id', '=', $userData->unit_id)
//                ->groupBy('competency_dictionary_id')
//                ->get();
//        }else {
//            //get profile
//            $softProfiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                ->where('competency_dictionaries.type_id', '=', '1')
//                ->where('fungsional_id', '=', $userData->fung_id)
//                ->where('jabatan_id', '=', $userData->unit_id)
//                ->groupBy('competency_dictionary_id')
//                ->get();
//
//            $hardProfiles = CompetencyProfile::with('competencyDictionary', 'competencyDictionary.level')
//                ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
//                ->where('competency_dictionaries.type_id', '=', '2')
//                ->where('fungsional_id', '=', $userData->fung_id)
//                ->where('jabatan_id', '=', $userData->unit_id)
//                ->groupBy('competency_dictionary_id')
//                ->get();
//        }

        $this->layout->content = View::make('competency::test.check', compact('softProfiles', 'hardProfiles', 'userId'));
    }

    public function result() {
        $this->layout->content = View::make('competency::test.result');
    }

    public function peersAction($typeId, $step = 1){

        $page= $step-1;

        if (Request::isMethod('post'))
        {

        }else{
            //data dari session
            $nip = Auth::user()->nip;

            $jabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $nip);

            //cek peers
            $peers = CompetencyPeers::getSoftPeers($this->competencyData->id, $nip);

            if($peers != null){
                //get jabatan Array
                $jabatanArray = RiwJabStruk::getJabatanofPeers($this->competencyData->date_start, $peers);

                //get profile by jabatan Array
                $profiles = CompetencyProfile::getProfilefromPeers($this->competencyData->id, $jabatanArray, $typeId)
                    ->take(1)
                    ->skip($page)
                    ->first();

                //get jabatan from profiles
                $jabatanProfile = CompetencyProfile::getJabatanfromProfile($this->competencyData->id, $profiles->competency_dictionary_id);

                //get user detail from jabatan
                $jabatan = array_intersect($jabatanArray, $jabatanProfile);
                $users = RiwJabStruk::getUserfromJabatan($this->competencyData->date_start, $jabatan);

                $this->layout->content = View::make('competency::test.peers', compact('profiles', 'users'));
            }
            else{
                dd('error');
            }
        }

    }

    public function getUpdate($dictionary_id){
        $breadcrumbs = array(
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Diri Sendiri" => ""),
            array("Update" => ""),
        );

        if ($this->checkActive() == true){
            set_time_limit(0);
            $user = Auth::user();

            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

            if($riwJabatan != false){

//                $profile = CompetencyProfile::getTestInv($user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $typeId);
                $dict = CompetencyDictionary::find($dictionary_id);

                $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
                $this->layout->content = View::make('competency::testInv.update', compact('dict'));
            }
        }
    }

    public function postUpdate($dictionary_id){
        if ($this->checkActive() == true){
            $userNip = Auth::user()->nip;
            // cek memiliki recap_id atau enggak
            $recap = CompetencyRecap::where('competency_id', '=', $this->competencyData->id)
                ->where('user_nip', '=', $userNip)
                ->first();

            if (is_null($recap)){
                //get jabatan
                $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userNip);

                $recap = new CompetencyRecap;
                $recap->competency_id = $this->competencyData->id;
                $recap->user_nip = $userNip;
                $recap->occupation_id = $riwJabatan->unit_staf_id;

                $recap->save();
            }

            //simpan ke dalam database
            $test = new CompetencyTest;
            $test->competency_id = $this->competencyData->id;
            $test->competency_recap_id = $recap->id;
            $test->competency_dictionary_id = Input::get('compId');
            $test->user_id = $userNip;
            $test->rater_id = $userNip;
            $test->level = Input::get('level');
            $test->evidence = Input::get('evidence');


            if($test->save()){
                return Redirect::to('competency/progress/inv');
            }
        }
    }

}
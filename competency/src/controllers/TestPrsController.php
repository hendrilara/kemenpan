<?php namespace Meniqa\Competency\Controllers;

/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/30/14
 * Time: 8:49 AM
 */

use BaseController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyPeers;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyRecap;
use Meniqa\Competency\Models\CompetencyTest;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

class TestPrsController extends BaseController {

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
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Orang Lain" => ""),
        );

        $user = Auth::user();

        //list Peers
        $listPeers = CompetencyPeers::with('user', 'rater')
            ->where('rater_id', '=', $user->nip)
            ->where(function($query) {
                $query->where('status', '=', 'kolega');
//                    ->orWhere('status', '=', 'customer');
            })
            ->get();
//        return $listPeers;

        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

        $bawahan = DafUnitStaff::with('bawahan.bawahan')->where('unit_staf_id', '=', $riwJabatan->unit_staf_id)->first();
        $atasan = DafUnitStaff::with('atasan')->where('unit_staf_id', '=', $riwJabatan->unit_staf_id)->first();
//        return $atasan;

        $data = array();
        foreach ($listPeers as $peers){
            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $peers->user_id);
            $totalProfile = count(CompetencyProfile::getProfileAll($riwJabatan->unit_staf_id, $this->competencyData->id));
            $checkProfile = count(CompetencyProfile::checkTestPrs($peers->user_id, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id));

            $totalSoftProfile       = count(CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, 1));
            $totalManagerialProfile = count(CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, 2));

            $checkSoftProfile = count(CompetencyProfile::checkTestPrsType($peers->user_id, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, 1));
            $checkManagerialProfile = count(CompetencyProfile::checkTestPrsType($peers->user_id, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, 2));

            $data[] = array(
                'id'                    => $peers->id,
                'jabatan'               => $riwJabatan->jabatan->nama_lengkap,
                'nama'                  => $peers->user->nama,
                'status'                => $peers->status,
                'progressSoft'          => "".$totalSoftProfile-$checkSoftProfile." pengisian dari ".$totalSoftProfile." kompetensi",
                'progressManagerial'    => "".$totalManagerialProfile-$checkManagerialProfile." pengisian dari ".$totalManagerialProfile." kompetensi",
                'progress'              => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
            );
        }

        //list bawahan level 1 & 2
        if ((isset($bawahan->bawahan)) && ($bawahan->bawahan != null)){
            foreach ($bawahan->bawahan as $rowBawahanlvl1){
                //get user
                $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, $rowBawahanlvl1->unit_staf_id);
                if ((isset($userBawahan)) && ($userBawahan != null)){

                    $totalProfile = count(CompetencyProfile::getProfileAll($rowBawahanlvl1->unit_staf_id, $this->competencyData->id));
                    $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $rowBawahanlvl1->unit_staf_id, $this->competencyData->id));

                    $totalSoftProfile       = count(CompetencyProfile::getProfile($rowBawahanlvl1->unit_staf_id, $this->competencyData->id, 1));
                    $totalManagerialProfile = count(CompetencyProfile::getProfile($rowBawahanlvl1->unit_staf_id, $this->competencyData->id, 2));

                    $checkSoftProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowBawahanlvl1->unit_staf_id, $this->competencyData->id, 1));
                    $checkManagerialProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowBawahanlvl1->unit_staf_id, $this->competencyData->id, 2));

                    $data[] = array(
                        'id'                    => $userBawahan->nip,
                        'jabatan'               => $rowBawahanlvl1->nama_lengkap,
                        'nama'                  => $userBawahan->pegawai->nama,
                        'status'                => 'bawahan level 1',
                        'progressSoft'          => "".$totalSoftProfile-$checkSoftProfile." pengisian dari ".$totalSoftProfile." kompetensi",
                        'progressManagerial'    => "".$totalManagerialProfile-$checkManagerialProfile." pengisian dari ".$totalManagerialProfile." kompetensi",
                        'progress'              => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                    );
                }



                //list bawahan level 2
                if ((isset($bawahan->bawahan->bawahan)) && ($bawahan->bawahan->bawahan != null)){
                    foreach ($bawahan->bawahan as $rowBawahanlvl2){
                        //get user
                        $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, [$rowBawahanlvl2->unit_staf_id]);
                        if ((isset($userBawahan)) && ($userBawahan != null)){
                            $totalProfile = count(CompetencyProfile::getProfileAll($rowBawahanlvl2->unit_staf_id, $this->competencyData->id));
                            $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $rowBawahanlvl2->unit_staf_id, $this->competencyData->id));

                            $totalSoftProfile       = count(CompetencyProfile::getProfile($rowBawahanlvl2->unit_staf_id, $this->competencyData->id, 1));
                            $totalManagerialProfile = count(CompetencyProfile::getProfile($rowBawahanlvl2->unit_staf_id, $this->competencyData->id, 2));

                            $checkSoftProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowBawahanlvl2->unit_staf_id, $this->competencyData->id, 1));
                            $checkManagerialProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowBawahanlvl2->unit_staf_id, $this->competencyData->id, 2));

                            $data[] = array(
                                'id'                    => $userBawahan->nip,
                                'jabatan'               => $rowBawahanlvl2->nama_lengkap,
                                'nama'                  => $userBawahan->pegawai->nama,
                                'status'                => 'bawahan level 2',
                                'progressSoft'          => "".$totalSoftProfile-$checkSoftProfile." pengisian dari ".$totalSoftProfile." kompetensi",
                                'progressManagerial'    => "".$totalManagerialProfile-$checkManagerialProfile." pengisian dari ".$totalManagerialProfile." kompetensi",
                                'progress'              => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                            );
                        }
                    }
                }
            }
        }
        if ((isset($atasan->atasan)) && ($atasan->atasan != null)){

            $rowAtasan = $atasan->atasan;
//                return $rowAtasan;
                //get user
                $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, $rowAtasan->unit_staf_id);
                if ((isset($userBawahan)) && ($userBawahan != null)){

                    $totalProfile = count(CompetencyProfile::getProfileAll($rowAtasan->unit_staf_id, $this->competencyData->id));
                    $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $rowAtasan->unit_staf_id, $this->competencyData->id));

                    $totalSoftProfile       = count(CompetencyProfile::getProfile($rowAtasan->unit_staf_id, $this->competencyData->id, 1));
                    $totalManagerialProfile = count(CompetencyProfile::getProfile($rowAtasan->unit_staf_id, $this->competencyData->id, 2));

                    $checkSoftProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowAtasan->unit_staf_id, $this->competencyData->id, 1));
                    $checkManagerialProfile = count(CompetencyProfile::checkTestPrsType($userBawahan->nip, $user->nip, $rowAtasan->unit_staf_id, $this->competencyData->id, 2));

                    $data[] = array(
                        'id'                    => $userBawahan->nip,
                        'jabatan'               => $rowAtasan->nama_lengkap,
                        'nama'                  => $userBawahan->pegawai->nama,
                        'status'                => 'atasan',
                        'progressSoft'          => "".$totalSoftProfile-$checkSoftProfile." pengisian dari ".$totalSoftProfile." kompetensi",
                        'progressManagerial'    => "".$totalManagerialProfile-$checkManagerialProfile." pengisian dari ".$totalManagerialProfile." kompetensi",
                        'progress'              => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                    );
                }

        }

//        return $data;

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::testPrs.index', compact('data'));

    }

    public function getAction($type, $id){
        $user = Auth::user();
        $peers = CompetencyPeers::find($id);
        if ($peers != null){
            //get User
            $pegawai = MasterPegawai::find($peers->user_id);
        }else{
            $pegawai = MasterPegawai::find($id);
        }


        //get jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $pegawai->nip);

        if($riwJabatan != false){
            $profile = CompetencyProfile::getTestPrs($pegawai->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $type);
            $totalProfile = count(CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $type));
            $checkProfile = count(CompetencyProfile::checkTestPrsType($pegawai->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $type));

            $this->layout->content = View::make('competency::testPrs.type', compact('profile', 'pegawai', 'totalProfile', 'checkProfile'));
        }
    }

    public function postAction($type, $id){
        $userNip = Auth::user()->nip;

        $peers = CompetencyPeers::find($id);
        if ($peers != null){
            //get User
            $pegawai = MasterPegawai::find($peers->user_id);
        }else{
            $pegawai = MasterPegawai::find($id);
        }

        // cek memiliki recap_id atau enggak
        $recap = CompetencyRecap::where('competency_id', '=', $this->competencyData->id)
            ->where('user_nip', '=', $pegawai->nip)
            ->first();

        if (is_null($recap)){
            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $pegawai->nip);

            $recap = new CompetencyRecap;
            $recap->competency_id = $this->competencyData->id;
            $recap->user_nip = $pegawai->nip;
            $recap->occupation_id = $riwJabatan->unit_staf_id;

            $recap->save();
        }

        //simpan ke dalam database
        $test = new CompetencyTest;
        $test->competency_id = $this->competencyData->id;
        $test->competency_recap_id = $recap->id;
        $test->competency_dictionary_id = Input::get('compId');
        $test->user_id = $pegawai->nip;
        $test->rater_id = $userNip;
        $test->level = Input::get('level');
        $test->evidence = Input::get('evidence');


        if($test->save()){
            return Redirect::to('competency/test/prs/action/'.$type.'/'.$id.'');
        }
    }

    public function getUpdate($dictionary_id, $peersNip){
        $user = Auth::user();
        $pegawai = MasterPegawai::find($peersNip);

        //get jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $pegawai->nip);

        if($riwJabatan != false){
            //$profile = CompetencyProfile::getTestPrs($pegawai->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id, $type);
            $dict = CompetencyDictionary::find($dictionary_id);

            $this->layout->content = View::make('competency::testPrs.update', compact('dict', 'pegawai'));
        }
    }

    public function postUpdate($dictionary_id, $peersNip){
        $userNip = Auth::user()->nip;

        $pegawai = MasterPegawai::find($peersNip);

        // cek memiliki recap_id atau enggak
        $recap = CompetencyRecap::where('competency_id', '=', $this->competencyData->id)
            ->where('user_nip', '=', $pegawai->nip)
            ->first();

        if (is_null($recap)){
            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $pegawai->nip);

            $recap = new CompetencyRecap;
            $recap->competency_id = $this->competencyData->id;
            $recap->user_nip = $pegawai->nip;
            $recap->occupation_id = $riwJabatan->unit_staf_id;

            $recap->save();
        }

        //simpan ke dalam database
        $test = new CompetencyTest;
        $test->competency_id = $this->competencyData->id;
        $test->competency_recap_id = $recap->id;
        $test->competency_dictionary_id = Input::get('compId');
        $test->user_id = $pegawai->nip;
        $test->rater_id = $userNip;
        $test->level = Input::get('level');
        $test->evidence = Input::get('evidence');


        if($test->save()){
            return Redirect::to('competency/progress/prs');
        }
    }
}
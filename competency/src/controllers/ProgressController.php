<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/24/14
 * Time: 10:01 AM
 */

use BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyPeers;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

class ProgressController extends BaseController {

    protected $layout = 'layouts.backend.main';

    function __construct(){
        //get competency schedule active
        $competencyActive = Competency::where('status', '=', 'active')->first();
        if ($competencyActive->count()){
            $this->competencyId = $competencyActive->id;
            $this->competencyData = $competencyActive;
        }else{
            $this->layout->content = View::make('competency::test.forbidden');
        }
    }

    public function action() {
        //data dari session
        $nip = Auth::user()->nip;

        //jabatan
        $jabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $nip);

        //get profile
        $softProfiles = CompetencyProfile::getProfilebyJabatan($jabatan->unit_staf_id, 1)->get();
        $hardProfiles = CompetencyProfile::getProfilebyJabatan($jabatan->unit_staf_id, 2)->get();
    }

    public function getInv(){
        $breadcrumbs = array(
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Kemajuan" => ""),
            array("Diri Sendiri" => ""),
        );

        $user = Auth::user();

        //get jabatan
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);

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
//        return $data;

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::progress.individu', compact('data'));
    }

    public function getPrs(){
        $breadcrumbs = array(
            array("Kompetensi" => ""),
            array("Pengukuran" => ""),
            array("Kemajuan" => ""),
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
        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $user->nip);
        $bawahan = DafUnitStaff::with('bawahan.bawahan')->where('unit_staf_id', '=', $riwJabatan->unit_staf_id)->first();
        $atasan = DafUnitStaff::with('atasan')->where('unit_staf_id', '=', $riwJabatan->unit_staf_id)->first();

        $data = array();
        $competencyType = CompetencyType::all();
        foreach ($listPeers as $peers){
            //get jabatan
            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $peers->user_id);
            $totalProfile = count(CompetencyProfile::getProfileAll($riwJabatan->unit_staf_id, $this->competencyData->id));
            $checkProfile = count(CompetencyProfile::checkTestPrs($peers->user_id, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id));

            $result = array();
            foreach ($competencyType as $rowType){
                $profile = CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $rowType->id);

                $result[] = array(
                    'type' => array(
                        'id' => $rowType->id,
                        'name' => $rowType->name,
                    ),
                    'profile' => $profile,
                );
            }

            $data[] = array(
                'id' => $peers->id,
                'nip' => $peers->user_id,
                'nama' => $peers->user->nama,
                'status' => $peers->status,
                'progress' => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                'data' => $result
            );
        }

        //list bawahan level 1 & 2
        if ((isset($bawahan->bawahan)) && ($bawahan->bawahan != null)){
            foreach ($bawahan->bawahan as $rowBawahanlvl1){
                //get user
                $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, $rowBawahanlvl1->unit_staf_id);
                if ((isset($userBawahan)) && ($userBawahan != null)){
                    $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userBawahan->nip);
                    $totalProfile = count(CompetencyProfile::getProfileAll($riwJabatan->unit_staf_id, $this->competencyData->id));
                    $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id));

                    $result = array();
                    foreach ($competencyType as $rowType){
                        $profile = CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $rowType->id);

                        $result[] = array(
                            'type' => array(
                                'id' => $rowType->id,
                                'name' => $rowType->name,
                            ),
                            'profile' => $profile,
                        );
                    }

                    $data[] = array(
                        'id' => $userBawahan->nip,
                        'nip' => $userBawahan->nip,
                        'nama' => $userBawahan->pegawai->nama,
                        'status' => 'bawahan level 1',
                        'progress' => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                        'data' => $result
                    );
                }

                //list bawahan level 2
                if ((isset($bawahan->bawahan->bawahan)) && ($bawahan->bawahan->bawahan != null)){
                    foreach ($bawahan->bawahan as $rowBawahanlvl2){
                        //get user
                        $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, [$rowBawahanlvl2->unit_staf_id]);
                        if ((isset($userBawahan)) && ($userBawahan != null)){
                            $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userBawahan->nip);
                            $totalProfile = count(CompetencyProfile::getProfileAll($riwJabatan->unit_staf_id, $this->competencyData->id));
                            $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id));

                            $result = array();
                            foreach ($competencyType as $rowType){
                                $profile = CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $rowType->id);

                                $result[] = array(
                                    'type' => array(
                                        'id' => $rowType->id,
                                        'name' => $rowType->name,
                                    ),
                                    'profile' => $profile,
                                );
                            }

                            $data[] = array(
                                'id' => $userBawahan->nip,
                                'nip' => $userBawahan->nip,
                                'nama' => $userBawahan->pegawai->nama,
                                'status' => 'bawahan level 2',
                                'progress' => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                                'data' => $result
                            );
                        }
                    }
                }
            }
        }

        //list atasan
        if ((isset($atasan->atasan)) && ($atasan->atasan != null)){
            $rowAtasan = $atasan->atasan;
            //get user
            $userBawahan = RiwJabStruk::getUser($this->competencyData->date_start, $rowAtasan->unit_staf_id);
            if ((isset($userBawahan)) && ($userBawahan != null)){
                $riwJabatan = RiwJabStruk::getJabatanOnCompetency($this->competencyData->date_start, $userBawahan->nip);
                $totalProfile = count(CompetencyProfile::getProfileAll($riwJabatan->unit_staf_id, $this->competencyData->id));
                $checkProfile = count(CompetencyProfile::checkTestPrs($userBawahan->nip, $user->nip, $riwJabatan->unit_staf_id, $this->competencyData->id));

                $result = array();
                foreach ($competencyType as $rowType){
                    $profile = CompetencyProfile::getProfile($riwJabatan->unit_staf_id, $this->competencyData->id, $rowType->id);

                    $result[] = array(
                        'type' => array(
                            'id' => $rowType->id,
                            'name' => $rowType->name,
                        ),
                        'profile' => $profile,
                    );
                }

                $data[] = array(
                    'id' => $userBawahan->nip,
                    'nip' => $userBawahan->nip,
                    'nama' => $userBawahan->pegawai->nama,
                    'status' => 'atasan',
                    'progress' => "".$totalProfile-$checkProfile." pengisian dari ".$totalProfile." kompetensi",
                    'data' => $result
                );
            }
        }

//        return $data;

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::progress.peers', compact('data'));
    }
}
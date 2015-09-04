<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 2/3/15
 * Time: 12:20 PM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyPeers;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

class AdminPeersController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    public function anyIndex(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kolega & bawahan" => ""),
        );

        $competencyActive = Competency::getActive();

        //list karyawan
        if (Input::has('keyword')){
            $pegawai = MasterPegawai::where('master_pegawai.nip', 'like', '%'.Input::get('keyword').'%')->orWhere('master_pegawai.nama', 'like', '%'.Input::get('keyword').'%')->mastertoDafunitStaff($competencyActive)->paginate(10);
        }else{
            $pegawai = MasterPegawai::mastertoDafUnitStaff($competencyActive)->paginate(10);
        }
//        return $pegawai;
        //list jabatan
        $jabatan = DafUnitStaff::all();

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminPeers.index', compact('pegawai', 'jabatan', 'competencyActive'));
    }

    public function getDelete($id){
        $competencyActive = Competency::getActive();

        CompetencyPeers::where('id', '=', $nip)->delete();

        return Redirect::to('admin/competency/peers')->with('message', 'data kolega berhasil dihapus');
    }

    public function getDetail($nip){
        $competencyActive = Competency::getActive();

        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kolega & bawahan" => ""),
            array("Update data" => ""),
        );

        //get jabatan
//        $riwJabatan = RiwJabStruk::getJabatanOnCompetency($competencyActive->date_start, $nip);

        //list all pegawai
        $pegawai = MasterPegawai::mastertoDafUnitStaff($competencyActive)->get();

        //get user detail
        $masterPegawai = MasterPegawai::getDetailbyDate($competencyActive->date_start, $nip);

        //get peers
        $peers = CompetencyPeers::with('rater')->where('user_id', '=', $nip)->where('competency_id', '=', $competencyActive->id)->get();

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminPeers.update', compact('masterPegawai', 'peers', 'pegawai'));
    }

    public function apiDetail($id){
        $competencyActive = Competency::getActive();

        $peers = CompetencyPeers::with('rater.jabatanpengukuran.jabatan.unit')
            ->find($id);

        return $peers;
    }


}
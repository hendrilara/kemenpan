<?php namespace Meniqa\EmployeeMenpan\Models;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 2/3/15
 * Time: 7:57 PM
 */

use BaseModel;

class RiwJabStruk extends BaseModel {

    public $timestamps = false;

    protected $connection = 'siasik';

    protected $table = 'riw_jab_struk';

    protected $primaryKey = 'mutasi_id';


    public function jabatan(){
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\DafUnitStaff', 'unit_staf_id', 'unit_staf_id');
    }

    public function pegawai(){
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\MasterPegawai', 'nip', 'nip');
    }

    /**
     * @param $competencyDateStart
     * @param $userNip
     * @return $jabatan
     */
    public static function getJabatanOnCompetency($competencyDateStart, $userNip){
        $jabatan = RiwJabStruk::with('jabatan')
            ->where('nip', '=', $userNip)
            ->where('tmt_mulai', '<=', $competencyDateStart)
            ->where(function ($query) use ($competencyDateStart){
                $query->where('tmt_selesai', '>=', $competencyDateStart)
                    ->orWhere('tmt_selesai', '=', '0000-00-00');
            })
            ->orderBy('tmt_mulai', 'DESC')->first();

        if (count($jabatan) > 0)
            return $jabatan;
        else
            return null;
    }

    /**
     * @param $competencyDateStart
     * @param $peers
     * @return array
     */
    public static  function getJabatanofPeers($competencyDateStart, $peers){
        //get jabatan peers
        $jabatanArray = array();
        foreach ($peers as $peer){
            //get jabatan per user
            $jabatan = RiwJabStruk::getJabatanOnCompetency($competencyDateStart, $peer->user_id);

            if($jabatan != null)
                $jabatanArray[] = $jabatan->unit_staf_id;
        }

        return $jabatanArray;
    }

    /**
     * @param $competencyDateStart
     * @param array $jabatan
     * @return null
     */
    public static function getUserfromJabatan($competencyDateStart, $jabatan){
        $user = RiwJabStruk::with('pegawai')
            ->whereIn('unit_staf_id', $jabatan)
            ->where('tmt_mulai', '<=', $competencyDateStart)
            ->where(function ($query) use ($competencyDateStart){
                $query->where('tmt_selesai', '>=', $competencyDateStart)
                    ->orWhere('tmt_selesai', '=', '0000-00-00');
            })->get();

        if ($user->count())
            return $user;
        else
            return null;
    }

    public static function getUser($competencyDateStart, $jabatan){
        $user = RiwJabStruk::with('pegawai')
            ->where('unit_staf_id', $jabatan)
            ->where('tmt_mulai', '<=', $competencyDateStart)
            ->where(function ($query) use ($competencyDateStart){
                $query->where('tmt_selesai', '>=', $competencyDateStart)
                    ->orWhere('tmt_selesai', '=', '0000-00-00');
            })->first();

        if ($user != null)
            return $user;
        else
            return null;
    }

}
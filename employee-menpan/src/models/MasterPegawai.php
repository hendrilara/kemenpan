<?php namespace Meniqa\EmployeeMenpan\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 4:43 AM
 */

use BaseModel;
use Meniqa\Competency\Models\Competency;

class MasterPegawai extends BaseModel {

    public $timestamps = false;

    protected $connection = 'siasik';

    protected $table = 'master_pegawai';

    protected $primaryKey = 'nip';

    public static function getDetailbyDate($date, $nip){
        $jabatan = RiwJabStruk::with('jabatan', 'pegawai', 'jabatan.unit')
            ->where('nip', '=', $nip)
            ->where('tmt_mulai', '<=', $date)
            ->where(function ($query) use ($date){
                $query->where('tmt_selesai', '>=', $date)
                    ->orWhere('tmt_selesai', '=', '0000-00-00');
            })
            ->orderBy('tmt_mulai', 'DESC')->first();

        if (count($jabatan) > 0)
            return $jabatan;
        else
            return null;
    }

    public function scopeMastertoDafUnitStaff($query, $competencyActive){
        return $query->join('riw_jab_struk', 'master_pegawai.nip', '=', 'riw_jab_struk.nip')
            ->join('daf_unit_staf', 'riw_jab_struk.unit_staf_id', '=', 'daf_unit_staf.unit_staf_id')
            ->where('riw_jab_struk.tmt_mulai', '<=', $competencyActive->date_start)
            ->where(function ($query) use ($competencyActive){
                $query->where('riw_jab_struk.tmt_selesai', '>=', $competencyActive->date_start)
                    ->orWhere('riw_jab_struk.tmt_selesai', '=', '0000-00-00');
            })
            ->orderBy('master_pegawai.nama');
    }

    public function mutasi(){
        return $this->hasMany('Meniqa\EmployeeMenpan\Models\RiwJabStruk', 'nip', 'nip');
    }

    public function jabatanpengukuran(){
        $competency = Competency::getActive();

        return $this->hasMany('Meniqa\EmployeeMenpan\Models\RiwJabStruk', 'nip', 'nip')
            ->where('tmt_mulai', '<=', $competency->date_start)
            ->where(function ($query) use ($competency){
                $query->where('tmt_selesai', '>=', $competency->date_start)
                    ->orWhere('tmt_selesai', '=', '0000-00-00');
            });
    }
}
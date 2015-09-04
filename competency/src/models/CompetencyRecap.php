<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 1:59 AM
 */

class CompetencyRecap extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_recaps';

    public function pegawai() {
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\MasterPegawai', 'user_nip', 'nip');
    }

    public function competency(){
        return $this->belongsTo('Meniqa\Competency\Models\Competency', 'competency_id', 'id');
    }

    public function jabatan(){
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\DafUnitStaff', 'occupation_id', 'unit_staf_id');
    }

    public static function getlistAll($competencyId){
        return CompetencyRecap::where('competency_id', '=', $competencyId)->get();
    }
}
<?php namespace Meniqa\EmployeeMenpan\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/21/14
 * Time: 8:47 PM
 */

use BaseModel;
//use Illuminate\Database\Eloquent;

class DafUnitStaff extends BaseModel {

    protected $connection = 'siasik';

    public $timestamps = false;

    protected $table = 'daf_unit_staf';

    protected $primaryKey = 'unit_staf_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit() {
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\DafUnit', 'unit_staf_id', 'unit_id');
    }

    public function bawahan() {
        return $this->hasMany('Meniqa\EmployeeMenpan\Models\DafUnitStaff', 'unit_parent_id', 'unit_staf_id');
    }

    public function atasan(){
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\DafUnitStaff', 'unit_parent_id', 'unit_staf_id');
    }

}
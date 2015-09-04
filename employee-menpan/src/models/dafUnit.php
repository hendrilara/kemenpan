<?php namespace Meniqa\EmployeeMenpan\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/21/14
 * Time: 8:47 PM
 */

use BaseModel;
//use Illuminate\Database\Eloquent;

class DafUnit extends BaseModel {

    protected $connection = 'siasik';

    public $timestamps = false;

    protected $table = 'daf_unit';

    protected $primaryKey = 'unit_id';

}
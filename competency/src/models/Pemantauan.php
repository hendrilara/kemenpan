<?php

namespace Meniqa\Competency\Models;

/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/3/14
 * Time: 12:39 PM
 */
use BaseModel;

class Pemantauan extends BaseModel {

    protected $fillable = array('id');
    protected $table = 'diklat_pelaksanaan';
    public $timestamps = true;

}

?>
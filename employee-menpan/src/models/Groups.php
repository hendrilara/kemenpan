<?php namespace Meniqa\EmployeeMenpan\Models;

/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/29/14
 * Time: 10:48 AM
 */

use BaseModel;

class Groups extends BaseModel {

    protected $table = 'groups';

    function user(){
        return $this->belongsToMany('Meniqa\EmployeeMenpan\Models\Users', 'users_groups', 'user_id', 'group_id');
    }
}
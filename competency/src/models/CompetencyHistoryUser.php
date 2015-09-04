<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 9:22 AM
 */

use BaseModel;

class CompetencyHistoryUser extends BaseModel {

    protected $softDelete = false;
    public $timestamps = false;

    protected $table = 'competency_history_users';

}
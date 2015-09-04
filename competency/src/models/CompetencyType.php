<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 1:59 AM
 */

class CompetencyType extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_types';

    /**
     * Ardent validation rules
     * @var array
     */
    static public $rules = array(
        'name'    => 'required',
    );
}
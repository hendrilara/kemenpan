<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 8:49 AM
 */

class CompetencyDictionaryLevel extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_dictionary_levels';

    /**
     * Ardent validation rules
     * @var array
     */
    static public $rules = array(
        'dictionary_id'   => 'required|integer',
        'value'      => 'required',
        'title'     => 'required',
    );

    public function dictionary() {
        return $this->belongsTo('Meniqa\Models\CompetencyDictionary', 'dictionary_id', 'id');
    }
}
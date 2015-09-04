<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 1:59 AM
 */

class CompetencyRecapIndividuals extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_recap_individuals';

    public function recap() {
        return $this->belongsTo('Meniqa\Competency\Models\CompetencyRecap', 'competency_recap_id', 'id');
    }

    public function dictionary(){
        return $this->belongsTo('Meniqa\Competency\Models\CompetencyDictionary', 'competency_dictionary_id', 'id');
    }

}
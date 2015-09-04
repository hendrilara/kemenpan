<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 2:01 AM
 */

class CompetencyDictionary extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_dictionaries';

    /**
     * Ardent validation rules
     * @var array
     */
    static public $rules = array(
        'type_id'   => 'required|integer',
        'code'      => 'required',
        'title'     => 'required',
    );

    public static function getByParentType($parent = null, $type = null){
        if ($parent == null){
            if ($type == null){
                $listData = CompetencyDictionary::with('kepala', 'competencyType')->paginate(10);
            }else{
                $listData = CompetencyDictionary::with('kepala', 'competencyType')->where('type_id', '=', $type)->paginate(10);
            }
        }elseif($parent === "parent"){
            if ($type == null){
                $listData = CompetencyDictionary::with('kepala', 'competencyType')->where('parent', '=', 0)->paginate(10);
            }else{
                $listData = CompetencyDictionary::with('kepala', 'competencyType')->where('parent', '=', 0)->where('type_id', '=', $type)->paginate(10);
            }
        }else{
            dd('5');
            $listData = CompetencyDictionary::with('kepala', 'competencyType')->where('parent', '=', $parent)->paginate(10);
        }

        return $listData;
    }

    public function competencyType() {
        return $this->belongsTo('Meniqa\Models\CompetencyType', 'type_id', 'id');
    }

    public function kepala() {
        return $this->belongsTo('Meniqa\Models\CompetencyDictionary', 'parent', 'id');
    }

    public function child() {
        return $this->hasMany('Meniqa\Models\CompetencyDictionary', 'parent', 'id');
    }

    public function level() {
        return $this->hasMany('Meniqa\Models\CompetencyDictionaryLevel', 'dictionary_id', 'id');
    }

}
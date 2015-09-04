<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/3/14
 * Time: 12:39 PM
 */

use BaseModel;

class Competency extends BaseModel {

    protected $softDelete = true;

    protected $table = 'competencies';

    /**
     * Ardent validation rules
     * @var array
     */
    static public $rules = array(
        'company_id'    => 'required|integer',
        'year'          => 'required|integer',
        'date_start'    => 'required',
        'date_end'      => 'required',
    );

    public function competencyQuestion() {
        return $this->hasMany('Meniqa\Models\CompetencyQuestion', 'competency_id', 'id');
    }

    public static function getActive() {
        return Competency::where('status', '=', 'active')->first();
    }

    public static function checkActive(){
        $competency =  Competency::where('status', '=', 'active')->first();

        if (count($competency) > 0){
            $dateStart = strtotime($competency->date_start);
            $dateEnd = strtotime($competency->date_end);
            $now = strtotime('now');

            if ($now < $dateStart){
                return 200;
            }elseif ($now > $dateEnd){
                return 300;
            }else{
                return 1;
            }
        }else{
            return false;
        }
    }

    public function getStatusIndAttribute($value){
        switch ($this->status){
            case "pending":
                return "tunda";
            break;
            case "active":
                return "aktif";
            break;
            case "archive":
                return "arsip";
            break;
        }
    }

}
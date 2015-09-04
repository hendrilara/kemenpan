<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 8/22/14
 * Time: 1:59 AM
 */

use Illuminate\Support\Facades\DB;

class CompetencyTest extends \BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_tests';

    public function dictionary(){
        return $this->belongsTo('Meniqa\Models\CompetencyDictionary', 'competency_dictionary_id', 'id');
    }

    public function dictionarylevel(){
        return $this->belongsTo('Meniqa\Models\CompetencyDictionaryLevel', 'level', 'id');
    }

    public static function checkTest($dictionaryId, $userId, $raterId){
        $test = CompetencyTest::with('dictionarylevel')->where('competency_dictionary_id', '=', $dictionaryId)
            ->where('user_id', '=', $userId)
            ->where('rater_id', '=', $raterId)
            ->first();
        return $test;
    }

    public static function getAvgTest($dictionaryId, $userNip){
        $sql = "SELECT a.*, AVG (b.`value`) as lvl
          FROM competency_tests a
          JOIN competency_dictionary_levels b ON a.`level` = b.id
          WHERE a.competency_dictionary_id = ".$dictionaryId."
          AND a.user_id = ".$userNip."";
        $arr = DB::select(DB::raw($sql));
        return $arr[0];
    }

}
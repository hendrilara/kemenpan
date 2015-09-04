<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/15/14
 * Time: 9:20 AM
 */

use BaseModel;
use Illuminate\Support\Facades\DB;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

/**
 * Class CompetencyProfile
 * @package Meniqa\Competency\Models
 */
class CompetencyProfile extends BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_profiles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competencyDictionary() {
        return $this->belongsTo('Meniqa\Competency\Models\CompetencyDictionary', 'competency_dictionary_id', 'id');
    }

    public function jabatan(){
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\DafUnitStaff', 'jabatan_id', 'unit_staf_id');
    }

    /**
     * @param $nip
     * @param $competencyId
     * @param $typeId
     * @return mixed
     */
    public static function getProfile($jabatanId, $competencyId, $typeId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $typeId)
            ->groupBy('competency_dictionary_id')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->get();

        return $profile;
    }

    public static function getTestInv($userId, $jabatanId, $competencyId, $typeId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_dictionaries.description', 'competency_dictionaries.detail as cdetail', 'competency_dictionaries.parent', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $typeId)
            ->groupBy('competency_dictionary_id')
            ->whereRaw('competency_dictionaries.id NOT IN (SELECT competency_dictionary_id FROM competency_tests WHERE user_id = '.$userId.' AND rater_id = '.$userId.')')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->take(1)
            ->get();

        return $profile;
    }

    public static function checkTestInv($userId, $jabatanId, $competencyId, $typeId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_dictionaries.description', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $typeId)
            ->groupBy('competency_dictionary_id')
            ->whereRaw('competency_dictionaries.id NOT IN (SELECT competency_dictionary_id FROM competency_tests WHERE user_id = '.$userId.' AND rater_id = '.$userId.')')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->get();

        return $profile;
    }

    public static function getProfileAll($jabatanId, $competencyId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->groupBy('competency_dictionary_id')
            ->get();

        return $profile;
    }

    public static function getTestPrs($userId, $raterId, $jabatanId, $competencyId, $typeId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_dictionaries.description', 'competency_dictionaries.detail as cdetail', 'competency_dictionaries.parent', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $typeId)
            ->groupBy('competency_dictionary_id')
            ->whereRaw('competency_dictionaries.id NOT IN (SELECT competency_dictionary_id FROM competency_tests WHERE user_id = '.$userId.' AND rater_id = '.$raterId.')')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->take(1)
            ->get();

        return $profile;
    }

    public static function checkTestPrs($userId, $raterId, $jabatanId, $competencyId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_dictionaries.description', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->groupBy('competency_dictionary_id')
            ->whereRaw('competency_dictionaries.id NOT IN (SELECT competency_dictionary_id FROM competency_tests WHERE user_id = '.$userId.' AND rater_id = '.$raterId.')')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->get();

        return $profile;
    }

    public static function checkTestPrsType($userId, $raterId, $jabatanId, $competencyId, $typeId) {
        $profile = DB::table('competency_profiles')
            ->select('competency_dictionaries.code', 'competency_dictionaries.title', 'competency_dictionaries.description', 'competency_profiles.*')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('jabatan_id', '=', $jabatanId)
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $typeId)
            ->groupBy('competency_dictionary_id')
            ->whereRaw('competency_dictionaries.id NOT IN (SELECT competency_dictionary_id FROM competency_tests WHERE user_id = '.$userId.' AND rater_id = '.$raterId.' AND type_id = '.$typeId.')')
            ->orderBy('competency_dictionaries.order', 'ASC')
            ->orderBy('competency_dictionaries.code', 'ASC')
            ->get();

        return $profile;
    }



    /**
     * @param $query
     * @param $jabatanId
     * @param $competencyTypeId
     * @return mixed
     */
    public function scopeGetProfilebyJabatan($query, $jabatanId, $competencyTypeId) {
        return $query->with('competencyDictionary', 'competencyDictionary.level')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('competency_dictionaries.type_id', '=', $competencyTypeId)
            ->where('jabatan_id', $jabatanId)
            ->groupBy('competency_dictionary_id');
    }

    /**
     * @param $query
     * @param $competencyId
     * @param $jabatanArray
     * @param $competencyTypeId
     * @return mixed
     */
    public function scopeGetProfilefromPeers($query, $competencyId, $jabatanArray, $competencyTypeId){
        return $query->with('competencyDictionary', 'competencyDictionary.level')
            ->join('competency_dictionaries', 'competency_profiles.competency_dictionary_id', '=', 'competency_dictionaries.id')
            ->where('competency_id', '=', $competencyId)
            ->where('competency_dictionaries.type_id', '=', $competencyTypeId)
            ->whereIn('jabatan_id', $jabatanArray)
            ->groupBy('competency_dictionary_id');
    }

    /**
     * @param $competencyId
     * @param $competencyDictionaryId
     * @return array|null
     */
    public static function getJabatanfromProfile($competencyId, $competencyDictionaryId) {
        $profiles = CompetencyProfile::where('competency_id', '=', $competencyId)
            ->where('competency_dictionary_id', '=', $competencyDictionaryId)
            ->get();

        if($profiles->count()){
            $jabatanArray = array();
            foreach ($profiles as $profile){
                $jabatanArray[] = $profile->jabatan_id;
            }
            return $jabatanArray;
        }else {
            return null;
        }
    }

    public static function getProfilefromRecapNip($userNip) {
        $sql = "SELECT b.*
            FROM competency_recaps a
            JOIN competency_profiles b ON a.occupation_id = b.jabatan_id
            WHERE a.user_nip = ".$userNip."";
        $arr = DB::select(DB::raw($sql));
        return $arr;
    }

    public static function getProfilebyRecapType($userNip, $typeId){
        $sql = "SELECT c.type_id, c.title, c.`code`, b.rcl, d.ccl
          FROM competency_recaps a
          JOIN competency_profiles b ON a.occupation_id = b.jabatan_id
          JOIN competency_dictionaries c ON b.competency_dictionary_id = c.id
          JOIN competency_recap_individuals d ON a.id = d.competency_recap_id AND c.id = d.competency_dictionary_id
          WHERE a.user_nip = ".$userNip."
          AND c.type_id = ".$typeId."";
        $arr = DB::select(DB::raw($sql));
        return $arr;
    }

}
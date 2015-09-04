<?php namespace Meniqa\Competency\Models;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/24/14
 * Time: 3:55 AM
 */

use BaseModel;

class CompetencyPeers extends BaseModel {

    protected $softDelete = true;

    protected $table = 'competency_peers';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competency() {
        return $this->belongsTo('Meniqa\Competency\Models\Competency', 'competency_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\MasterPegawai', 'user_id', 'nip');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rater() {
        return $this->belongsTo('Meniqa\EmployeeMenpan\Models\MasterPegawai', 'rater_id', 'nip');
    }

    /**
     * @param $competencyId
     * @param $userNip
     * @return \Illuminate\Database\Eloquent\Collection|null|static[]
     */
    public static function getSoftPeers($competencyId, $userNip) {
        $peers = CompetencyPeers::with('user', 'rater')
            ->where('competency_id', '=', $competencyId)
            ->where('rater_id', '=', $userNip)
            ->get();

        if($peers->count())
            return $peers;
        else
            return null;
    }

    public static function getPeersByStatus($competencyId, $userNip, $status){
        $peers = CompetencyPeers::where('user_id', '=', $userNip)
            ->where('competency_id', '=', $competencyId)
            ->where('status', '=', $status)
            ->groupBy('rater_id')
            ->get();

        return $peers;
    }
}
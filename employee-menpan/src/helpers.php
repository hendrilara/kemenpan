<?php
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 11:40 AM
 */

use Meniqa\Competency\Models\CompetencyHistoryUser;
use Meniqa\EmployeeMenpan\Models\Groups;
use Meniqa\EmployeeMenpan\Models\User;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;

function user_fullname(){
    if (Auth::check()) {
        $nip = Auth::user()->nip;

        $userData = MasterPegawai::where('nip', '=', $nip)->first();
        return $userData;
    }else {
        return false;
    }

}

function isAdmin(){
    if (Auth::check()) {
        $idUser = Auth::user()->id;

        //check Admin group = 1
        $isAdmin = DB::table('users_groups')->where('user_id', $idUser)->where('group_id', '1')->first();
        if(count($isAdmin) > 0)
            return true;
        else
            return false;

    }else {
        return false;
    }
}

function isPegawai(){
    if (Auth::check()) {
        $idUser = Auth::user()->id;

        //check Pegawai group = 2
        $isAdmin = DB::table('users_groups')->where('user_id', $idUser)->where('group_id', '2')->first();
        if(count($isAdmin) > 0)
            return true;
        else
            return false;

    }else {
        return false;
    }
}
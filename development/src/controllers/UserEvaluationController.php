<?php namespace Meniqa\Development\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 10/21/14
 * Time: 7:59 AM
 */

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;
use Meniqa\EmployeeMenpan\Models\DafUnit;
use Meniqa\EmployeeMenpan\Models\DafUnitStaff;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\RiwJabStruk;

class UserEvaluationController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function index(){
    	
        $this->layout->content = View::make('development::userevaluation.index');
    }

}
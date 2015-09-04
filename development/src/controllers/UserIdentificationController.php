<?php namespace Meniqa\Development\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 10/20/14
 * Time: 10:28 PM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyRecap;
use Meniqa\Competency\Models\CompetencyRecapIndividuals;

class UserIdentificationController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function getIndex(){
        $breadcrumbs = array(
            array('Competency' => ""),
            array('Diklat' => ""),

            );

        $competencyAll = Competency::all();
         $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('development::useridentification.index', compact('competencyAll'));
    }

    public function postIndex(){
         $breadcrumbs = array(
            array('Competency' => ""),
            array('Diklat' => ""),

            );
        $competencyAll = Competency::all();
        $recap = CompetencyRecap::where('competency_id', Input::get('cli'))->first();
        $recapInv = CompetencyRecapIndividuals::with('dictionary')
            ->where('competency_recap_id', $recap->id)
            ->where('gap', '<', 0)
            ->get();
       //return $recapInv;

        $this->layout->content = View::make('development::useridentification.index', compact('competencyAll', 'recap', 'recapInv'));
    }

    Public function ambilIndex(){
        $competency = CompetencyRecap::all();

        return $competency;
    }
}
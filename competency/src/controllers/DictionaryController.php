<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/21/14
 * Time: 8:43 PM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use Meniqa\Models\CompetencyDictionary;
use PDF;
use Lang;
use App;

use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\EmployeeMenpan\Models\DafUnit;

class DictionaryController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function listUnit(){
        $units = DafUnit::paginate(20);

        $this->layout->content = View::make('competency::dictionary.unit', compact('units'));
    }

    public function downloadUnit($idUnit) {
        $unit = DafUnit::find($idUnit);
//        $profiles = CompetencyProfile::with(['competencyDictionary' => function($q) use($idUnit) {
//
//            }])->where('jabatan_id', '=', $idUnit)->get();
        $profiles = CompetencyProfile::with(['competencyDictionary' => function($q) use($idUnit) {
                $q->with('level')->get();
            }])->where('jabatan_id', '=', $idUnit)->get();

        if(count($profiles) > 0){
//            echo "<pre>";
//            print_r($profiles) ;
            return $profiles;
//            $dictionaries = CompetencyDictionary::with('competencyType', 'kopet', 'child', 'level')->take('20')->get();

            $html = View::make('competency::dictionary.unitDownload', compact('profiles'));
//            return $html;
            return PDF::load($html, 'A4', 'portrait')->show($unit->nama);
        }else{
            dd('tidak memiliki kompetensi');
        }
    }

    public function detail($idDictionary) {
        $dictionary = CompetencyDictionary::with('level')->find($idDictionary);
//        return $dictionary;

        $this->layout->content = View::make('competency::dictionary.detail', compact('dictionary'));
    }
}


<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 10/19/14
 * Time: 4:57 PM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Meniqa\Competency\Models\Competency;
use Meniqa\Competency\Models\CompetencyProfile;
use Meniqa\Competency\Models\CompetencyType;

class UserProfileController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function index() {
        $competencies = Competency::all();
        $competencyTypes = CompetencyType::all();
        $this->layout->content = View::make('competency::userprofile.index', compact('competencies', 'competencyTypes'));
    }

    public function getProfile() {

        $rules = array(
            'competency'      => 'required',
            'type'            => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            dd(Input::all());
            Redirect::back()->with('errorMessage', 'inputan salah');
        }else{
            $competencies = Competency::all();
            $competencyTypes = CompetencyType::all();

            $type = Input::get('type');
            $competency = Input::get('competency');
            $nip = Auth::user()->nip;

            $profile = CompetencyProfile::getProfile($nip, $competency, $type)->get();
//            return $profile;

            $this->layout->content = View::make('competency::userprofile.index', compact('competencies', 'competencyTypes', 'profile'));
        }
    }
}
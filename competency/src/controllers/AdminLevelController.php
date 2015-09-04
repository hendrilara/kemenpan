<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/30/14
 * Time: 12:49 AM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyDictionaryLevel;

class AdminLevelController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    protected $rules = array(
        'dictionary_id' => 'required|integer',
        'value' => 'required|integer',
        'title' =>'required',
        'description' => 'required'
    );

    public function getDictionary($id){
        $dataDictionary = CompetencyDictionary::find($id);
        $dataLevel = CompetencyDictionaryLevel::where('dictionary_id', '=', $id)->get();

        $this->layout->content = View::make('competency::adminLevel.dictionary', compact('dataDictionary', 'dataLevel'));
    }

    public function getCreate($id){
        $data = new CompetencyDictionaryLevel();
        $dataDictionary = CompetencyDictionary::find($id);

        $this->layout->content = View::make('competency::adminLevel.create', compact('data'));
    }

    public function postCreate($id){
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()->withErrors($messages);
        }else{
            $data = new CompetencyDictionary();
            $data->dictionary_id = Input::get('dictionary_id');
            $data->value = Input::get('value');
            $data->title = Input::get('title');
            $data->description = Input::get('description');

            if($data->save()){
                return Redirect::to('admin/competency/level/dictionary/'.$id);
            }else{
                return Redirect::back();
            }
        }

//        dd('under construction');
    }

    public function getJsondetail($id){
        $data = CompetencyDictionaryLevel::find($id);
        return $data;
    }

    public function getUpdate($id){
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()->withErrors($messages);
        }else{
            $data = CompetencyDictionaryLevel::find($id);
            $data->value = Input::get('value');
            $data->title = Input::get('title');
            $data->description = Input::get('description');

            if($data->save()){
                return Redirect::to('admin/competency/level/dictionary/'.$data->dictionary_id);
            }else{
                return Redirect::back();
            }
        }
//        dd('under construction');
    }

    public function getDelete($id){
        $data = CompetencyDictionaryLevel::find($id);
        $dictionaryId = $data->dictionary_id;

        $data->delete();
        return Redirect::to('admin/competency/level/dictionary'.$dictionaryId)->with('message', 'hapus data berhasil');
    }
}
<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/29/14
 * Time: 11:18 PM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Meniqa\Competency\Models\CompetencyDictionary;
use Meniqa\Competency\Models\CompetencyType;

class AdminDictionaryController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    protected $rules = array(
        'type_id' => 'required|integer',
        'code' => 'required',
        'title' =>'required',
        'description' => 'required',
        'cakupan' => 'required'
    );

    public function anyIndex(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kamus Kompetensi" => ""),
        );

//        return Input::all();
        if ((Input::has('type')) && (Input::has('parent'))){
            if(Input::get('parent') == 'all'){
                if(Input::get('type') == 'all'){
                    $listData = CompetencyDictionary::getByParentType(null, null);
                }else{
                    $listData = CompetencyDictionary::getByParentType(null, Input::get('type'));
                }
            }elseif(Input::get('parent') == 0){
                if(Input::get('type') == 'all'){
                    $listData = CompetencyDictionary::getByParentType("parent", null);
                }else{
                    $listData = CompetencyDictionary::getByParentType("parent", Input::get('type'));
                }
            }else{
                $listData = CompetencyDictionary::getByParentType(Input::get('parent'), Input::get('type'));
            }
        }else{
            $listData = CompetencyDictionary::getByParentType(null, null);
        }

        $listDataParent = CompetencyDictionary::where('parent', '=', '0')->get();
        $listDataType = CompetencyType::all();

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminDictionary.index', compact('listData', 'listDataParent', 'listDataType'));
    }

    public function getDelete($id){
        $data = CompetencyDictionary::find($id);

        $data->delete();
        return Redirect::to('admin/competency/dictionary')->with('message', 'data berhasil dihapus');
    }

    public function getCreate(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kamus Kompetensi" => ""),
            array("Tambah Data" => ""),
        );

        $dataType = CompetencyType::all();
        $dataParent = CompetencyDictionary::where('parent', '=', 0)->get();
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminDictionary.update', compact('dataType', 'dataParent'));
    }

    public function postCreate(){
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()->withErrors($messages);
        }else{
            $data = new CompetencyDictionary();
            $data->type_id = Input::get('type_id');
            $data->order_deputi = Input::get('order_deputi');
            $data->code = Input::get('code');
            $data->parent = Input::get('parent');
            $data->title = Input::get('title');
            $data->description = Input::get('description');

            $detail['cakupan'] = Input::get('cakupan');
            $data->detail = json_encode($detail);
            if($data->save()){
                return Redirect::to('admin/dictionary/detail');
            }else{
                return Redirect::back();
            }
        }
    }

    public function getUpdate($id) {
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kamus Kompetensi" => ""),
            array("Ubah Data" => ""),
        );

        $data = CompetencyDictionary::find($id);
        $dataType = CompetencyType::all();
        $dataParent = CompetencyDictionary::where('parent', '=', 0)->get();
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminDictionary.update', compact('data', 'dataType', 'dataParent'));
    }

    public function postUpdate($id) {
        $validator = Validator::make(Input::all(), $this->rules);

        if($validator->fails()){
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()->withErrors($messages);
        }else{
            $data = CompetencyDictionary::find($id);
            $data->type_id = Input::get('type_id');
            $data->order_deputi = Input::get('order_deputi');
            $data->code = Input::get('code');
            $data->parent = Input::get('parent');
            $data->title = Input::get('title');
            $data->description = Input::get('description');

            $detail['cakupan'] = Input::get('cakupan');
            $data->detail = json_encode($detail);
            if($data->save()){
                return Redirect::to('admin/competency/dictionary/detail/'.$id);
            }else{
                return Redirect::back();
            }
        }
    }

    public function getDetail($id) {
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Kamus Kompetensi" => ""),
            array("Detail" => ""),
        );

        $data = CompetencyDictionary::find($id);

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminDictionary.detail', compact('data'));
    }
}
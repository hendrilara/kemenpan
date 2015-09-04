<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/29/14
 * Time: 9:25 PM
 */

use BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Meniqa\Competency\Models\CompetencyType;

class AdminTypeController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    protected $rules = array(
        'name' => 'required',
    );

    public function getIndex(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Tipe Kompetensi" => ""),
        );

        $listData = CompetencyType::paginate(10);

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminType.index', compact('listData'));
    }

    public function getCreate(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Tipe Kompetensi" => url("admin/competency/type")),
            array("Tambah tipe kompetensi" => url("admin/competency/type/create")),
        );
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminType.create');
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
            $competencyType = new CompetencyType();
            $competencyType->name = Input::get('name');
            if($competencyType->save()){
                return Redirect::to('admin/competency/type')->with('message', 'tambah data berhasil dilakukan');
            }else{
                return Redirect::back();
            }
        }
    }

    public function getUpdate($id){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Tipe Kompetensi" => ""),
            array("Ubah Data" => ""),
        );

        $data = CompetencyType::find($id);

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminType.update', compact('data'));
    }

    public function postUpdate($id){
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::back()->withErrors($messages);

        }else{
            $competencyType = CompetencyType::find($id);
            $competencyType->name = Input::get('name');
            if($competencyType->save()){
                return Redirect::to('admin/competency/type')->with('message', 'tambah data berhasil dilakukan');
            }else{
                return Redirect::back();
            }
        }
    }

    public function getDelete($id){
        $data = CompetencyType::find($id);

        $data->delete();
        return Redirect::to('admin/competency/type')->with('message', 'data berhasil dihapus');
    }
}
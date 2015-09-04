<?php namespace Meniqa\Competency\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/30/14
 * Time: 1:43 AM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Meniqa\Competency\Models\Competency;

class AdminScheduleController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    protected $rules = array(
        'year' => 'required',
        'date_start' => 'required',
        'date_end' =>'required',
        'status' => 'required',
    );

    public function getIndex() {
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Jadwal Kompetensi" => ""),
        );

        $listData = Competency::paginate(10);

        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminSchedule.index', compact('listData'));
    }

    public function getDelete($id) {
        $data = Competency::find($id);

        $data->delete();
        return Redirect::to('admin/competency/schedule/')->with('message', 'data berhasil dihapus');
    }

    public function getCreate(){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Jadwal Kompetensi" => ""),
            array("Tambah Data" => ""),
        );

        $schedule = new Competency();
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminSchedule.create', compact('schedule'));
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
            $year = substr(Input::get('year'), 0, 5);
            if ((Input::get('status') == 'active') && (count(Competency::getActive()) > 0)){
                //check active
                return Redirect::back()->with('message', 'data gagal ditambah');
            }else{
                $schedule = new Competency();
                $schedule->year = (int)$year;
                $schedule->date_start = Input::get('date_start');
                $schedule->date_end = Input::get('date_end');
                $schedule->status = Input::get('status');

                $schedule->save();
                return Redirect::to('admin/competency/schedule/')->with('message', 'data berhasil ditambah');
            }
        }

    }

    public function getUpdate($id){
        $breadcrumbs = array(
            array("Kompetensi" => url("admin/competency/type")),
            array("Jadwal Kompetensi" => ""),
            array("Ubah Data" => ""),
        );

        $schedule = Competency::find($id);
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminSchedule.create', compact('schedule'));
    }

    public function postUpdate(){
        dd('under construction');
    }
}
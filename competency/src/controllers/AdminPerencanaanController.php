<?php

namespace Meniqa\Competency\Controllers;

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Paginator;

class AdminPerencanaanController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    public function index() {
        //fungsional
        $unit = Input::get('unit');
        //manajerial & inti
        $unitt = Input::get('unitt');
        if (isset($unit)) {
             $deputi = DB::table('competency_recap_individuals')
                ->join('competency_dictionaries', 'competency_recap_individuals.competency_dictionary_id', '=', 'competency_dictionaries.id')
                ->join('competency_types', 'competency_dictionaries.type_id', '=', 'competency_types.id')
                ->join('competency_recaps', 'competency_recap_individuals.competency_recap_id', '=', 'competency_recaps.id')
                ->join('asesment_kelas','competency_recaps.occupation_id','=','asesment_kelas.unit_staf_id')
                     ->select(DB::RAW('round(avg(competency_recap_individuals.gap),2) as gap, count(competency_recaps.user_nip) as nip'), 'competency_dictionaries.type_id', 'competency_types.name', 'competency_dictionaries.title', 'competency_recap_individuals.itj', 'competency_recap_individuals.rcl', 'competency_recap_individuals.ccl', 'competency_dictionaries.id', 'competency_dictionaries.type_id')
                ->where('asesment_kelas.unit','=',"$unit")
                     //->where('gap', '<', '0')
                ->orderBy('gap', 'asc')
                ->orderBy('itj', 'desc')
                ->groupBy('competency_dictionaries.id')
                //->get()
                ->paginate(15);
        }
        if (isset($unit)) {
             $deputti = DB::table('competency_recap_individuals')
                ->join('competency_dictionaries', 'competency_recap_individuals.competency_dictionary_id', '=', 'competency_dictionaries.id')
                ->join('competency_types', 'competency_dictionaries.type_id', '=', 'competency_types.id')
                ->join('competency_recaps', 'competency_recap_individuals.competency_recap_id', '=', 'competency_recaps.id')
                ->join('asesment_kelas','competency_recaps.occupation_id','=','asesment_kelas.unit_staf_id')
                     ->select(DB::RAW('round(avg(competency_recap_individuals.gap),2) as gap, count(competency_recaps.user_nip) as nip'), 'competency_dictionaries.type_id', 'competency_types.name', 'competency_dictionaries.title', 'competency_recap_individuals.itj', 'competency_recap_individuals.rcl', 'competency_recap_individuals.ccl', 'competency_dictionaries.id', 'competency_dictionaries.type_id')
                ->where('asesment_kelas.unit','=',"$unitt")
                     //->where('gap', '<', '0')
                ->orderBy('gap', 'asc')
                ->orderBy('itj', 'desc')
                ->groupBy('competency_dictionaries.id')
               ->paginate(15);
        }

        $kompetensi = DB::table('competency_types')->get();
        $diklat = DB::table('diklat_competency')->get();
        $combobox = DB::table('diklat_competency')->get();

        $rencana = DB::table('diklat_competency')
                ->join('competency_types', 'diklat_competency.id_competency', '=', 'competency_types.id')
                ->get();
        //susun perencanaan diklat inti
        $agendaf = DB::table('diklat_agenda')
                ->select('diklat_agenda.id','competency_types.name','diklat_competency.id_competency','diklat_competency.nama_kompetensi','diklat_agenda.jdwal_mulai','diklat_agenda.jdwal_selesai')
                ->join('diklat_competency','diklat_agenda.id_diklat_comp','=','diklat_competency.id')
                ->join('competency_types','diklat_competency.id_competency','=','competency_types.id')
                ->where('competency_types.id','=','1')
                ->paginate(10);
         //susun perencanaan diklat fungsional
        $agenda = DB::table('diklat_agenda')
                ->select('diklat_agenda.id','competency_types.name','diklat_competency.id_competency','diklat_competency.nama_kompetensi','diklat_agenda.jdwal_mulai','diklat_agenda.jdwal_selesai')
                ->join('diklat_competency','diklat_agenda.id_diklat_comp','=','diklat_competency.id')
                ->join('competency_types','diklat_competency.id_competency','=','competency_types.id')
                ->where('competency_types.id','=','2')
                ->paginate(10);
         


        $breadcrumbs = array(
            array('Kompetensi' => ""),
            array('Perencanaan' => ""),
        );
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminperencanaan.index', compact('tipe', 'rencana', 'kompetensi', 'deputi', 'deputti' , 'diklat','agenda','agendaf'));
    }
}

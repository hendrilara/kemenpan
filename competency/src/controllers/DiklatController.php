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
use Meniqa\Competency\Models\DiklatEvaluasi;

class DiklatController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    public function perencanaan($id) {
        $kompetensi = Input::get($id);

        print_r($kompetensi);
        $dikla = DB::table('diklat_competency')
                ->select('diklat_competency.id_competency', 'diklat_competency.nama_kompetensi', 'diklat_competency.id as iddiklat')
                ->where('id_competency', '=', "$id")
                ->get();
        return $dikla;
    }

    public function kompetensi($kompetensi, $idkompetensi) {
        //$komp = Input::get($kompetensi);
        $dikla = DB::table('diklat_competency')
                ->select('diklat_competency.id_competency', 'diklat_competency.nama_kompetensi', 'judul_diklat', 'competency_types.name', 'competency_types.id')
                ->join('competency_types', 'diklat_competency.id_competency', '=', 'competency_types.id')
                ->where('nama_kompetensi', 'LIKE', "%$kompetensi%")
                ->where('competency_types.id', '=', "$idkompetensi")
                ->get();
        return $dikla;
    }

    public function diklat($diklat) {
        $dik = DB::table('diklat_competency')
                ->select('deskripsi', 'id as id_comp')
                ->where('judul_diklat', 'LIKE', "%$diklat%")
                ->get();
        //print_r($dik);
        return $dik;
    }

    public function proses() {
        
        $rules = array(
            'ta' => 'required', //id dari diklat_competency
            'sasaran' => 'required',
            'jmlhari' => 'required',
            'kuota' => 'required',
            'anggaran' => 'required',
            'tglmulai' => 'required',
            'tglselesai' => 'required'
        );
        $messages = array(
            'ta.required' => 'Ada Beberapa Data Belum Terpilih ',
            'sasaran.required' => 'Sasaran Tujuan Belum Terisi ',
            'jmlhari.required' => 'Jumlah Hari Diklat Belum Terisi',
            'kuota.required' => 'Kuota Belum Terisi',
            'anggaran.required' => 'Anggaran Belum Terisi',
            'tglmulai.required' => 'Tanggal Mulai Belum Di pilih',
            'tglselesai.required' => 'Tanggal Selesai Belum Di pilih'
        );
        $validasi = validator::make(Input::all(), $rules, $messages);
        if ($validasi->fails()) {
            return Redirect::to('admin/diklat/diklat/tambah')
                            ->withErrors($validasi)
                            ->withInput();
        } else {
            $proses = new DiklatEvaluasi;
            $proses->id_diklat_comp = Input::get('ta');
            $proses->sasaran = Input::get('sasaran');
            $proses->kuota = Input::get('kuota');
            $proses->jmlhari = Input::get('jmlhari');
            $proses->anggaran = Input::get('anggaran');
            $proses->jdwal_mulai = Input::get('tglmulai');
            $proses->jdwal_selesai = Input::get('tglselesai');
            $proses->save();
            Session::flash('message', 'Berhasil Tambah Diklat Sudah Di Tambahkan');
            return Redirect::to('admin/diklat/perencanaan');
        }
        $breadcrumbs = array(
            array("Assessment Internal" => "javascript:void(0)"),
            array("Pengaturan" => ""),
            array("Kandidat Promosi Jabatan" => "")
        );
        $this->layout->content = View::make('competency::adminevaluasi/tambah', compact('kompetensi'));
    }

    public function tambah() {
        $kompetensi = DB::table('competency_types')->get();
  $breadcrumbs = array(
            array('Kompetensi' => ""),
            array('Perencanaan' => ""),
        );
 $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminevaluasi/tambah', compact('kompetensi'));
    }

    public function hapus($id) {
        if (isset($id)):else: echo"data tidak ditemukan";
        endif;
        $hapus = DiklatEvaluasi::find($id);
        $hapus->delete();
        Session::flash('message', 'Data Berhasil Di Hapus');
        return Redirect::to('admin/diklat/perencanaan');
    }

    public function preview($id) {
        if (isset($id)):else: echo"data tidak ditemukan";
        endif;
        $preview = DB::table('diklat_agenda')
                ->join('diklat_competency', 'diklat_agenda.id_diklat_comp', '=', 'diklat_competency.id')
                ->select('diklat_competency.id_competency', 'diklat_competency.nama_kompetensi', 'diklat_competency.judul_diklat', 'diklat_competency.deskripsi', 'diklat_agenda.sasaran', 'diklat_agenda.kuota', 'diklat_agenda.jmlhari', 'diklat_agenda.jdwal_mulai', 'diklat_agenda.jdwal_selesai', 'diklat_agenda.anggaran')
                ->where('diklat_agenda.id', '=', "$id")
                ->first();

        //exit();

        $breadcrumbs = array(
            array('Kompetensi' => ""),
            array('Perencanaan' => ""),
            array('Preview' => ""),
        );
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminevaluasi/preview', compact('preview'));
    }

}

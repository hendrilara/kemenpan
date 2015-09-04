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
use Meniqa\Competency\Models\Pemantauan;

class AdminPemantaoandiklatController extends BaseController {

    protected $layout = 'layouts.backend.admin';

    public function index() {

        $peserta = DB::table('diklat_pelaksanaan')
                ->join('diklat_agenda', 'diklat_pelaksanaan.id_agenda', '=', 'diklat_agenda.id')
                ->join('diklat_competency', 'diklat_agenda.id_diklat_comp', '=', 'diklat_competency.id')
                ->select('diklat_competency.nama_kompetensi', 'diklat_competency.judul_diklat', 'diklat_agenda.jdwal_mulai', 'diklat_agenda.jdwal_selesai', 'diklat_agenda.id')
                ->get();
        $breadcrumbs = array(
            array('Kompetensi' => ""),
            array('Pemantoan' => ""),
        );
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminpemantoan.index', compact('peserta'));
    }

    public function setujui($id) {

        $pelatihan = DB::table('diklat_pelaksanaan')
                ->join('diklat_agenda', 'diklat_pelaksanaan.id_agenda', '=', 'diklat_agenda.id')
                ->join('diklat_competency', 'diklat_agenda.id_diklat_comp', '=', 'diklat_competency.id')
                ->select(DB::RAW('diklat_competency.judul_diklat, Month(diklat_agenda.jdwal_mulai)as mulai,diklat_agenda.id,diklat_agenda.kuota'))
                ->where('diklat_agenda.id', '=', "$id")
                ->first();

        $pemantauan = DB::table('diklat_pelaksanaan')
                ->join('diklat_agenda', 'diklat_pelaksanaan.id_agenda', '=', 'diklat_agenda.id')
                ->join('diklat_competency', 'diklat_agenda.id_diklat_comp', '=', 'diklat_competency.id')
                ->join('db_pegawai.master_pegawai', 'diklat_pelaksanaan.nip', '=', 'db_pegawai.master_pegawai.nip')
                ->join('db_pegawai.daf_unit_staf', 'diklat_pelaksanaan.id_jabatan', '=', 'db_pegawai.daf_unit_staf.unit_staf_id')
                ->join('asesment_kelas', 'db_pegawai.daf_unit_staf.unit_staf_id', '=', 'asesment_kelas.unit_staf_id')
                ->select('db_pegawai.master_pegawai.nip', 'db_pegawai.master_pegawai.nama', 'db_pegawai.daf_unit_staf.nama_lengkap', 'diklat_competency.nama_kompetensi', 'diklat_competency.judul_diklat', 'diklat_agenda.jdwal_mulai', 'diklat_agenda.jdwal_selesai', 'diklat_agenda.id', 'diklat_pelaksanaan.setuju','diklat_pelaksanaan.id', 'asesment_kelas.unit')
                ->where('diklat_agenda.id', '=', "$id")
                ->groupBy('db_pegawai.master_pegawai.nip')
                ->get();


        $breadcrumbs = array(
            array('Kompetensi' => ""),
            array('Pemantoan' => ""),
        );
        $this->layout->breadcrumbs = View::make('layouts.breadcrumb', compact('breadcrumbs'));
        $this->layout->content = View::make('competency::adminpemantoan/setuji', compact('pemantauan', 'pelatihan'));
    }

    public function proses() {
        $id = Input::get('tex');
        $dik = DB::table('diklat_agenda')
                ->where('id','=',"$id")
                ->first();
        $rules = array(
            'setujui' => 'required'
        );
        $messages = array(
            'setujui.required' => 'Anda Belum Memilih'
        );
        $validasi = validator::make(Input::all(), $rules, $messages);
        if ($validasi->fails()) {
            return Redirect::back()
                            ->withErrors($validasi)
                            ->withInput();
        } else {
            $proses = Pemantauan::find($id);
            $proses->setuju = Input::get('setujui');
            $proses->save();
            Session::flash('message', 'Berhasil Tambah Diklat Sudah Di Tambahkan');
            return Redirect::back();
        }
    }

}

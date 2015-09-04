<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class ProfilingRekap extends \Eloquent{
		public $timestamps = false;
		protected $fillable = array('id','id_rekap','kategori','nip','id_jabatan');
    	protected $table = 'rekrutmen_rekap_profiling';
    }
?>
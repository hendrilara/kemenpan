<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class HeaderRekap extends \Eloquent{

		protected $fillable = array('id','id_asesmen','kategori','nama','tanggal_awal','tanggal_akhir','deksripsi');
    	protected $table = 'rekrutmen_rekap_header';
    }
?>
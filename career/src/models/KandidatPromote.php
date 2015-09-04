<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class KandidatPromote extends \Eloquent{
		//protected $softDelete = true;
		protected $fillable = array('id','unit_staf_id','tgl_awal','tgl_asesment','tgl_selesai','detail');
    	protected $table = 'asesment_promosi';
	}
?>
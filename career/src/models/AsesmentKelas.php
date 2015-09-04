<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class AsesmentKelas extends \Eloquent{

		protected $softDelete = true;
    	protected $table = 'asesment_kelas';
    
    	protected $fillable = array('unit','id','asesment_eselon_id','jabatan');

		public function asesmentEselon(){
		return $this->belongsTo('Meniqa\Models\AsesmentEselon','id','asesment_eselon_id');
		}

		public function cari($golek){
			
		}
	}
?>
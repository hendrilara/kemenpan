<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class Prasyarat extends \Eloquent{
		protected $softDelete = true;
    	protected $table = 'asesment_prasyarat_jabatan';
    	protected $fillable = array('id','asesment_eselon_id','asesment_prasyarat_id','nilai');

    	public function simpan(){
    		
    	}

    	public function HapusEselon($id, $ambil){
    		foreach ($ambil as $eselon) {
   				$eselon->delete();
			}
    		return true;
    	}
	}
?>
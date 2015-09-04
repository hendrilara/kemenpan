<?php namespace Meniqa\Career\Models;

use Eloquent;
	class AsesmentEselon extends \Eloquent{
		protected $softDelete = true;
    	protected $table = 'asesment_eselon';
    	protected $fillable = array('jabatan');
    	
		 // return $this->hasMany('AsesmentEselon',$table, 'id', 'asesment_eselon_id');
    	public function asesmentKelas(){
    		return $this->hasMany('Meniqa\Models\AsesmentKelas','asesment_eselon_id','id');
    	}
	}
?>
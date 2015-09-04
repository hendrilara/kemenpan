<?php namespace Meniqa\Career\Models;

use Eloquent;
use SoftDeletingTrait;


	class KandidatPromosiDaftar extends \Eloquent{

		protected $fillable = array('id','asesment_promosi_id','nip','detail');
    	protected $table = 'asesment_promosi_daftar';
    }
?>
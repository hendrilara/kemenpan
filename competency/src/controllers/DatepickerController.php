<?php namespace Meniqa\Competency\Controllers;

use BaseController;
use Illuminate\Support\Facades\View;
class DatepickerController extends BaseController{
	protected $layout = 'layouts.backend.admin';
	public function coba(){

		$this->layout->content = View::make('competency::coba');
	}
}

?>
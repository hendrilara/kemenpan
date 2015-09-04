<?php namespace Meniqa\Development\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 10/21/14
 * Time: 7:59 AM
 */

use BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CobaController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function index(){
    //    $this->layout->content = View::make('development::useridentificationdiktat.index');
    }
}
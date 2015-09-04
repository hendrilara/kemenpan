<?php namespace Meniqa\EmployeeMenpan\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 12/29/14
 * Time: 9:11 PM
 */

use BaseController;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends BaseController {

    protected $layout = 'layouts.backend.admin';


    public function dashboard(){

        $this->layout->content =  View::make('employeemenpan::dashboard.index');
    }
}
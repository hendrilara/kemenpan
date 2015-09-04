<?php namespace Meniqa\EmployeeMenpan\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 7:42 AM
 */

use BaseController;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\User;

class DashboardController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function index(){
//        return Redirect::to('dashboard/profile');
        $this->layout->content =  View::make('employeemenpan::dashboard.index');
    }

    public function profile(){
        $id = Auth::id();
        dd(Auth::user()->nip);
        $detail = MasterEmployee::with(['country', 'user', 'family' => function($table){
                $table->with(['status']);
            }])
            ->where('user_id', '=', $user->id)
            ->first();

        $this->layout->content = View::make('user.dashboard.profile', compact('detail'));
    }
}
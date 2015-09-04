<?php namespace Meniqa\EmployeeMenpan\Controllers;
/**
 * Created by PhpStorm.
 * User: masbenx
 * Date: 3/9/15
 * Time: 12:44 PM
 */

use BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Meniqa\EmployeeMenpan\Models\User;

class UserSetting extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function changePassword(){

        $rules = array(
            'newpassword'               => array('required', 'Confirmed'),
            'newpassword_confirmation'   => array('required', )
        );

        if(Input::has('newpassword')){
            $v = Validator::make(Input::all(), $rules);
            if( $v->passes() ) {
                # code for validation success!
                $user = Auth::user();

                $dataUser = User::where('username', '=', $user->nip)->first();
                $dataUser->password = Hash::make(Input::get('newpassword'));
                $dataUser->save();

                return Redirect::to('user/changepassword')->with('message', 'password berhasil di ubah');
            } else {
                # code for validation failure
                $messages = $v->messages();
                return Redirect::to('user/changepassword')->withErrors($messages);
            }
        }


        $this->layout->content =  View::make('employeemenpan::usersetting.changepassword');
    }
}
<?php namespace Meniqa\EmployeeMenpan\Controllers;
/**
 * Created by PhpStorm.
 * User: prasetyoherlambang
 * Date: 9/24/14
 * Time: 4:40 AM
 */

use BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Meniqa\EmployeeMenpan\Models\Groups;
use Meniqa\EmployeeMenpan\Models\MasterPegawai;
use Meniqa\EmployeeMenpan\Models\User;

class AuthController extends BaseController {

    protected $layout = 'layouts.backend.main';

    public function registration() {
        return View::make('employeemenpan::auth.registration');
    }

    public function login(){
        return View::make('employeemenpan::auth.login');
    }

    public function dologin(){
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' 	=> Input::get('username'),
                'password' 	=> Input::get('password')
            );

            $remember = (Input::has('remember_me')) ? true : false;

            // attempt to do the login
            if (Auth::attempt($userdata, $remember)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                return Redirect::to('user/dashboard');

            } else {
                // validation not successful, send back to form
                return Redirect::to('login')->with('message', 'session broken');
            }

        }
    }

    public function doRegister(){
        // validate the info, create rules for the inputs
        $rules = array(
            'nip' => 'required',
            'password' => 'required',
            'password_conf' =>'required|same:password'
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('registration')
                ->withErrors($validator); // send back all errors to the login form
        }else{
            //if user not found create it
            $user = User::where('nip', '=', Input::get('username'))->first();
            if (is_null($user)){
                //cek di bagian master pegawai
                $masterPegawai = MasterPegawai::where('nip', '=', Input::get('nip'))->first();
                if(! is_null($masterPegawai)){

                        // Validate, then create if valid
                        $newUser = new User;
                        $newUser->nip = Input::get('nip');
                        $newUser->username = Input::get('nip');
                        $newUser->password = Hash::make(Input::get('password'));

                        if($newUser->save()){
                            //attach to user roles
                            $newUser->group()->attach(2);

                            return View::make('employeemenpan::auth.successregistration');
                        }

                }else{
//                    dd('error 303');
                    return Redirect::to('registration')->with('message', 'nip tidak ditemukan dalam siAsik');
                }
            }else{
//                dd('error 403');
                return Redirect::to('registration')->with('message', 'nip sudah terdaftar dalam siMSDM-TBK ');
            }
        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function userData(){
        if (Auth::check()) {
            $user = Auth::user();

            return $user;
        }else {
            return false;
        }
    }

}
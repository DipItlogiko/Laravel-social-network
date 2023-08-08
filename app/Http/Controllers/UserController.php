<?php

namespace App\Http\Controllers;

use App\Models\Userdip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{ 
    ////__getDashboard__//
    public function getDashboard() {
        return view('dashboard');        
    }

    ////_____postSignUp__////
    public function postSignUp(Request $request){
        $email= $request['email'];
        $first_name= $request['first_name'];
        $password= bcrypt($request['password']);

        $user = new Userdip();

        $user->email = $email;
        $user->first_name =  $first_name;
        $user->password = $password;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    ////__postSignIn__////
    public function postSignIn(Request $request){

       if (Auth::attempt(['email' => $request['email']  , 'password'=> $request['password']  ])) {
        return redirect()->route('dashboard');
       }

       return redirect()->back();
    }
}

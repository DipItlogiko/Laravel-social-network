<?php

namespace App\Http\Controllers;

 
use App\Models\Userdip2;
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

        $this->validate($request , [
            'email' => 'required|email|unique:userdip2s', /////first email is my form input email and second email is from database and it must be unique and userdip2s is my database table name
            'first_name' => 'required|max:120', ////user will be able to write maximum 120 carectors in first_name field
            'password' => 'required|min:4'
        ]);


        $email= $request['email'];
        $first_name= $request['first_name'];
        $password= bcrypt($request['password']);

        $user = new Userdip2();

        $user->email = $email;
        $user->first_name =  $first_name;
        $user->password = $password;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    ////__postSignIn__////
    public function postSignIn(Request $request){

        $this->validate($request , [
            'email' => 'required', /////this email is my Signin form input field email 
            'password' => 'required'
        ]);

       if (Auth::attempt(['email' => $request['email']  , 'password'=> $request['password']  ])) {
        return redirect()->route('dashboard');
       }

       return redirect()->back();
    }
}

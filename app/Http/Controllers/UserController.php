<?php

namespace App\Http\Controllers;

 
use App\Models\Userdip2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class UserController extends Controller
{ 

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
        return redirect()->route('dashboard')->with(['message' => 'Signup Successfully' ]);
       }

       return redirect()->back();
    }


    ////__UserLogout__///
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home')->with([ 'message' => 'Logout Successfully!!!']);
    }



    ////__Account__////
    public function getAccount(){
        return view('account' , [ 'user' => Auth::user() ]);
    }


    ////__Account Save Post__////
    public function postSaveAccount(Request $request){
        //__validation__//
        $this->validate($request ,[
            'first_name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->first_name = $request['first_name'];
        $user->update();

        $file = $request->file('image'); //////image is my account.blade.php files input name that's why i have written this name in the file() function
        $filename = $request['first_name'] . '-' . $user->id . '.jpg'; /////my filename will be $request['first_name'] and it's mean '-'  space and $user->id and my file must be a jpg file and that's why i include '.jpg' here 
    
        if ($file) {
            Storage::disk('local')->put($filename , File::get($file)); ///////go config folder filesystems.php
        }

        return redirect()->route('account');
    }

    ////__UserImage__////
    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file , 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    ////__getDashboard__//
    public function getDashboard() {

        //$posts = Post::all();     //// here i will get all data from post database table 
        
        $posts = Post::orderBy('created_at' , 'desc')->get(); ///// here orderBy function will descinding (created_at) field of Post table......it will show your post table data and that data will show start from last to start i mean resent post will apper top of the post tabel  

        return view('dashboard' , [ 'posts' => $posts]);        
    }



    public function postCreatePost(Request $request)
    {
        //validation
        $this->validate($request ,[
            'body' => 'required|max:1000'
        ]); 


        $post = new Post();
 
        $post->body = $request['body'];

        ////$message='There was an error';

        if($request->user()->posts()->save($post)){
            $message='Post successfully created!';
        }

        return redirect()->route('dashboard') ->with(['message' => $message]);

    }


    public function getDeletePost( $post_id ) {
        $post = Post::where("id" , $post_id)->first();

        if(Auth::user() != $post-> user){
            return redirect()->back(); 
        } 

        $post-> delete();

        return redirect()->route('dashboard')->with(['message' => 'Successfully Deleted!!!']);
    }
}

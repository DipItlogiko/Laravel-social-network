<?php

namespace App\Http\Controllers;

use App\Models\Like;
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


    public function postEditPost(Request $request){

        //////validation
        $this->validate($request ,[
            'body' => 'required'
        ]);

        $post = Post::find($request['postId']); //////postId comes from app.js file

        if(Auth::user() != $post-> user){
            return redirect()->back();
        }

        $post->body = $request['body'];
        $post->update();

        return response()->json(["new_body" => $post->body , "new_date" => $post->updated_at],200);
    }


    public function getDeletePost(Request $request ) {
        $post = Post::find($request['post_id']);
           
        if(Auth::user() != $post->user){
            return redirect()->back();
        }

        $post->delete();

        return redirect()->route('dashboard')->with(['message' => 'Successfully Deleted!!!']);
        // return response()->json(['message' => 'Successfully Deleted!!!']);
    }


    public function postLikePost(Request $request)
    {
        $post_id = $request['POST_ID'];    //////POST_ID it comes from app.js

        $is_Like = $request['islike'] === 'true'; ////islike is come from app.js

        $update = false;

        $post = Post::find($post_id);

        if (!$post ) {
            return null;
        }

///////////// i don't understand here---------------------------------------
        $user = Auth::user(); // Auth::user() is equal to $request->user()
        $like = $user->likes()->where('post_id' , $post_id)->first(); ///// this likes() is my relation which i created in to the models file
///////////-----------------------------------------------------------------
        if($like){
            $already_like = $like -> like; //////the  like is my likes table fild name
            $update = true;

            if($already_like == $is_Like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }

        $like->like = $is_Like;

        $like->user_id = $user->id;

        $like->post_id = $post->id;

        if($update) {
            $like->update();
        } else {
            $like->save();
        }

        return null;
    }
}





// <a class="delete-post-pop-up" href="#">Delete</a> <!--go to public/src/js/app.js-------->
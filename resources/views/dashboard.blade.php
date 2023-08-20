<!-- <h1>The dashboard</h1> 
<p>{{ auth()->id() }}</p> -->

@extends('test.master')

@section('title')
dashboard
@endsection

@section('contaient')


@include('includes.message')

<section class="row new-post">
    <div class="col-md-6 col-md-offset-3">
        <header>
            <h3>What do you have to say?</h3>
            <form action=" {{ route('createpost') }} " method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="your post"></textarea>
                </div>

                <button class="btn btn-primary" type="submit">Create Post</button>
                <input type="hidden" name="_token" value=" {{ Session::token() }} ">
            </form>
        </header>
    </div>
</section>


<section class="row posts">
    <div class="col-md-6 col-md-offset-3">
        <header>
            <h3>What other people say...</h3>
        </header>
         <!-- $posts  is comes from PostController -->
        @foreach($posts as $post) 
         
            <article class="post" data-postid="{{ $post->id }}">    
                <p> {{ $post->body }} </p>   <!-- ($post->body)  it's mean my body fild of post table  -->
                
                <div class="info">
                   <!-- the below code has one problem ..the problem is when i create a new post that time don't match with my local time to solve this problem go to config/app.php and 'timezone' => UTC, change it 'timezone' => 'Asia/Dhaka', it will work-->
                  @if ($post->updated_at != $post->created_at) 
                    Updated on {{ $post->updated_at }}
                  @else
                    Post by {{ $post->user->first_name }} on {{ $post->created_at }}
                  @endif
                
                </div>

                <div class="interaction">
                   
                  @if(Auth::user() == $post->user)                    
                    <a href="#" class="edit">Edit</a>  <!--For make this edit button workable i have created a new folder in public/src/js and i have added a jquery cdn in master.blade.php file and i also have written this public/src/js script in master.blade.php------->
                    
                    <!--Delete confirmation pop-up----->
                    <!-- <a href="{{ route('postDelete' , ['post_id' => $post->id]) }}">Delete</a> ----without delete confirmation pop-up this one line code is enough for deleting post-->
                    <!-- href="{{ route('postDelete' , ['post_id' => $post->id]) }}" -->
                    <!-- href="javascript:confirm('Are you sure you want to delete?')" -->
                    <!-- data-post-id="{{ $post->id }}" -->
                    <a
                      class="delete-post-pop-up"
                      data-url-delete="{{ route('postDelete' , ['post_id' => $post->id]) }}"
                      href="#"
                    >
                      Delete
                    </a> <!--go to public/src/js/app.js-------->
                  @else                  
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id' , $post->id)->first()  ?  Auth::user()->likes()->where('post_id' , $post->id)->first()->like == 1 ? 'you like this post' : 'Like'  : 'Like' }} </a> <!--go to app.js----->
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id' , $post->id)->first()  ?  Auth::user()->likes()->where('post_id' , $post->id)->first()->like == 0 ? 'you don\'t like this post' : 'Dislike'  : 'Dislike' }}</a>
                  @endif
                    
                </div>
            </article>

        @endforeach

 

    </div>
</section>

<!--Edit Modal----->
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal"> <!--id =edit-modal   this id i have used in app.js file------->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
         
        <form action="" mathod="">
         
        <div class="form-group">

          <label for="post-body">Edit the post</label>
          <textarea class="form-control" name="post-body" id="post-body"   rows="5"></textarea>
        
        </div>

        </form>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Delete Pop-Up Modal-------->

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal"> <!--id ="delete-modal"   this id i have used in app.js file------->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this post?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="modal-confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>



<script>
  var token = '{{ Session::token() }}';
  var urlEdit = '{{ route('edit') }}'; /////chack app.js file and edit route
  var urlLike = '{{ route('like') }}';
  // var urlDelete = '{{ route('postDelete', ['post_id' => '#']) }}';
</script>

@endsection 

 
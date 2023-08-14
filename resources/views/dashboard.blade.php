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

        @foreach($posts as $post)
         
            <article class="post" data-postid="{{ $post->id }}">    
                <p> {{ $post->body }} </p>   <!-- ($post->body)  it's mean my body fild of post table  -->
                
                <div class="info">
                    Post by {{ $post->user->first_name }} on {{ $post->created_at }}
                </div>

                <div class="interaction">
                    <a href="#">Like</a>
                    <a href="#">Dislike</a>

                    @if(Auth::user() == $post->user)
                    
                    <a href="#" class="edit">Edit</a>  <!--For make this edit button workable i have created a new folder in public/src/js and i have added a jquery cdn in master.blade.php file and i also have written this public/src/js script in master.blade.php------->
                    <a href="{{ route('post-delete' , ['post_id' => $post->id]) }}">Delete</a>
                    
                    @endif
                    
                </div>
            </article>

        @endforeach

 

    </div>
</section>


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


<script>
  var token = '{{ Session::token() }}';
  var url = '{{ route('edit') }}';
</script>

@endsection 
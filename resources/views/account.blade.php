@extends('test.master')

@section('title')
   Account
@endsection


@section('contaient')

@include('includes.message')
<section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('accountSave') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>

    <!--below commented code has logical error here they are  using the user's first name as part of the image file name. When you change the user's first name, the filename changes, and this causes the image to appear as though it's "gone." that's why we are unable to watch user image after changing user first name ---------------------------------->

    <!-- @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('accountImage', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
    @endif -->

    @if (Storage::disk('local')->has($user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ route('accountImage', ['filename' => $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
        </section>
   @endif

@endsection
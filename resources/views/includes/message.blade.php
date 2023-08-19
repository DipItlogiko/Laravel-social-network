@if(count($errors) > 0)
    <div class="row">
        <div class="col-md-4 col-md-offset-4 ">  <!--  errorClass i have made it in public/src/css/main.css but it useless-->
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif


@if(Session::has('message'))
    <div class="row">
        <div class="col-md-4 col-md-offset-4 "> <!---- success i have made it in public/src/css/main.css but it useless-->
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
@endif

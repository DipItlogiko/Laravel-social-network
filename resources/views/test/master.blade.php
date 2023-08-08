<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>
 
@include('includes.headers') <!-- include , yield are called template expression -->

<div class="container">
    @yield('contaient')

</div>

</body>
</html>
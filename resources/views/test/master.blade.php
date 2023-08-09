<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
 
@include('includes.headers') <!-- include , yield are called template expression -->

<div class="container">
    @yield('contaient')

</div>

</body>
</html>
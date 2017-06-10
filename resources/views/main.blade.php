<!DOCTYPE html>
<html>
<head>
    @include('partials._head')
</head>
<body>

    @include('partials._nav')

    <!-- <img src="img/logo1.png" class="img-responsive" > -->
    
        @yield('logo')
        
    <div class="container-fluid content">
        @yield('content')
    </div>

	@include('partials._footer')

</body>
</html>
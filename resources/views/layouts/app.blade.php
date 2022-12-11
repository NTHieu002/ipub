<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/public/admin/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/public/admin/assets/img/favicon.png') }}">
    <title>iBOOK</title>

    <!-- Scripts -->
    <script src="{{ asset('./public/js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    {{-- <script src="{{ asset('/public/js/readepub.js') }}" defer></script> --}}
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('/public/css/app.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('/public/css/custom.css') }}" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
	{{-- epub.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
    <script src="{{ URL::to('https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js') }}"></script>
    


    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="{{ asset('/public/fonts/icomoon/style.css')}}">
	<link rel="stylesheet" href="{{ asset('/public/fonts/flaticon/font/flaticon.css')}}">
	<script src="https://kit.fontawesome.com/b6c63fd59a.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="{{ asset('/public/css/tiny-slider.css')}}">
	<link rel="stylesheet" href="{{ asset('/public/css/aos.css')}}">
	<link rel="stylesheet" href="{{ asset('/public/css/style.css')}}">
</head>
<body>
	{{-- header --}}
    @include('cus.layouts.header')

	

	{{-- main --}}
	<div class="main">
		@yield('content')
	</div>


	{{-- footer --}}
	@include('cus.layouts.footer')
	{{-- end footer --}}

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
    	<div class="spinner-border" role="status">
    		<span class="visually-hidden">Loading...</span>
    	</div>
    </div>

    <script src="{{ asset('/public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/public/js/tiny-slider.js')}}"></script>
    <script src="{{ asset('/public/js/aos.js')}}"></script>
    <script src="{{ asset('/public/js/navbar.js')}}"></script>
    <script src="{{ asset('/public/js/counter.js')}}"></script>
    <script src="{{ asset('/public/js/custom.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/public/js/custom-js.js')}}"></script>
</body>
</html>

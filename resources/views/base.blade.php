<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" type="text/css" href="../node_modules/bootstrap/dist/css/bootstrap.css">
        
        @yield('css')
    </head>
    <body>
    	@yield('content')
    	<input id="token" type="hidden" name="_token" value="{{ Session::token() }}">
    	<script src="{{ asset('js/jquery.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('js/signature_pad.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ asset('js/script.js') }}" type="text/javascript" charset="utf-8"></script>
		@yield('js')
    </body>
</html>

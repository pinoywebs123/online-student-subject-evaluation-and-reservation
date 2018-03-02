<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
        <meta name="COPYRIGHT" content="Nocturnal I.T Solutions"/>
        <meta name="DESCRIPTION" content="NORSU BCC Created by Morley and groupmates."/>
        <meta name="KEYWORDS" content="NORSU Negros Oriental State University"/>

        <meta name="ROBOTS" content="all"/>
        <title>NORSU BCC</title>
        @yield('styles')
      

       
    </head>
    <body>
        @yield('contents')
    </body>
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
    @yield('scripts')
</html>

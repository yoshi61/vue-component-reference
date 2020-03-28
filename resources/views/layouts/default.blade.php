<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ILF - @yield('page_title')</title>
</head>
<body>
<div id="app">
    @yield('content')
</div>
    @yield('scripts_before_body')

</body>
</html>

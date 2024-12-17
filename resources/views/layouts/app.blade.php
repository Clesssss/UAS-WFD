<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <x-navbar/>
        @yield('content')
        <x-footer/>
    </body>
</html>

@yield('script')

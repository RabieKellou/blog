<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        </head>
    <body>
        @if (session()->has('status'))
            <h3 style="color:green">{{ session()->get('status') }}</h3>
        @endif

        <nav class="navbar navbar-expand navbar-dark bg-success">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">New Post</a></li>

            </ul>
        </nav>
        <div class="container">

            @yield('content')
        </div>
       <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>

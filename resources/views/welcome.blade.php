<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4 mb-4 text-center"><h1><a href="{{ url('/') }}">JUMANJI</a></h1></div>
            @guest
            <div class="col-12 mb-4">
                <a class="btn btn-outline-dark btn-block" href="{{ route('register') }}">Créer un compte</a>
            </div>
            @else
            <div class="col-12 mb-4"><a class="btn btn-outline-danger btn-block" href="{{ route('launchGame') }}">Lancer une partie</a></div>
            <div class="col-6 mb-4">
                <a class="btn btn-outline-success btn-block" href="{{ route('joinGame') }}">Rejoindre une partie</a>
            </div>
            <div class="col-6 mb-4">
                <a class="btn btn-outline-dark btn-block" href="{{ route('oublie') }}">Lobotomie</a>
            </div>
            @endguest
           
        </div>
    </div>
</body>

</html>
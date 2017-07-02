<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InSense') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #d83535;
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a, .links > .row > .col-xs-12 > a {
            color: #fff;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .navbar{
            border:none;
        }
        .navbar-default .navbar-nav>li>a {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;

        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .img-responsive
        {
            padding: 20px;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="{{ url('/') }}">
                    {{ config('app.name', 'InSense') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Entrar</a></li>
                        <li><a href="{{ route('register') }}">Cadastrar</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <img class="img-responsive" src="{{asset('/img/logo-inverted.png')}}"/>
            </div>
            <span>Documentação/Repositórios:</span>
            <div class="links">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="{{ url('/tcc/docs') }}">Docs. Projeto</a>
                        <a href="{{ url('/api/docs') }}">Docs. API</a>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <a href="https://github.com/thiduzz/InSense-Web">Web</a>
                        <a href="https://github.com/thiduzz/InSense-Mobile">Mobile</a>

                    </div>
                </div>
            </div>
            <span>Outros:</span>
            <div class="links">
                <a href="{{ url('/equipe') }}">Equipe</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

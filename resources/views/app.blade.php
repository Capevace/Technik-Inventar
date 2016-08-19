<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            @yield('title', 'Technik Inventar')
        </title>
        <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: local('Roboto'), local('Roboto-Regular'), url(https://fonts.gstatic.com/s/roboto/v15/oMMgfZMQthOryQo9n22dcuvvDin1pK8aKteLpeZ5c0A.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }
        </style>
        <link rel="stylesheet" href="{{ url(elixir('css/all.css')) }}" charset="utf-8">
        <script src="{{ url(elixir('js/all.js')) }}"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    		<link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-touch-icon-57x57.png">
    		<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-touch-icon-60x60.png">
    		<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-touch-icon-72x72.png">
    		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-touch-icon-76x76.png">
    		<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-touch-icon-114x114.png">
    		<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-touch-icon-120x120.png">
    		<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-touch-icon-144x144.png">
    		<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-touch-icon-152x152.png">
    		<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">
    		<link rel="icon" type="image/png" href="assets/img/favicons/favicon-32x32.png" sizes="32x32">
    		<link rel="icon" type="image/png" href="assets/img/favicons/android-chrome-192x192.png" sizes="192x192">
    		<link rel="icon" type="image/png" href="assets/img/favicons/favicon-96x96.png" sizes="96x96">
    		<link rel="icon" type="image/png" href="assets/img/favicons/favicon-16x16.png" sizes="16x16">
    		<link rel="manifest" href="assets/img/favicons/manifest.json">
    		<link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    		<link rel="shortcut icon" href="assets/img/favicons/favicon.ico">
    		<meta name="msapplication-TileColor" content="#2b5797">
    		<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-144x144.png">
    		<meta name="msapplication-config" content="assets/img/favicons/browserconfig.xml">
    		<meta name="theme-color" content="#ff4f4f">
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Technik Inventory
                    </a>
                </div>
                @if (Auth::user())
                    <div class="collapse navbar-collapse check-active-links" id="main-nav-collapse">
                        <ul class="nav navbar-nav">

                            <!-- ITEM DROPDOWN -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <!-- <span class="glyphicon glyphicon-user"></span> -->
                                    Artikel
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @permission('view-items')
                                        <li><a href="{{ url('items') }}">Artikel anzeigen</a></li>
                                    @endpermission

                                    @permission('create-items')
                                        <li><a href="{{ url('items/create') }}">Artikel hinzufügen</a></li>
                                    @endpermission

                                    @permission('manage-item-types')
                                        <li><a href="{{ url('items/types') }}">Artikel-Kategorien</a></li>
                                    @endpermission

                                    @permission('manage-broken-items')
                                        <li><a href="{{ url('items/broken') }}">Defekte Artikel</a></li>
                                    @endpermission
                                </ul>
                            </li>

                            <!-- JOB DROPDOWN -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <!-- <span class="glyphicon glyphicon-user"></span> -->
                                    Aufträge
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @permission('view-jobs')
                                    <li><a href="{{ url('jobs') }}">Aufträge anzeigen</a></li>
                                    @endpermission

                                    @permission('create-jobs')
                                    <li><a href="{{ url('jobs/create') }}">Auftrag hinzufügen</a></li>
                                    @endpermission
                                </ul>
                            </li>

                            @permission('manage-users')
                            <!-- USER DROPDOWN -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <!-- <span class="glyphicon glyphicon-user"></span> -->
                                    Nutzer
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('users') }}">Nutzer anzeigen</a></li>
                                    <li><a href="{{ url('users/create') }}">Nutzer hinzufügen</a></li>
                                </ul>
                            </li>
                            @endpermission


							@permission('manage-funds')
                            <!-- USER DROPDOWN -->
                            <li><a href="{{ url('funds') }}">Gelder</a></li>
                            @endpermission
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
							<li><a>Hallo {{ Auth::user()->name }}</a></li>
                            <li><a href="{{ url('logout') }}">Ausloggen</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </nav>
        <div class="container">

            @if(session()->has('message'))
                <div class="alert alert-{{ session('message')['type'] }} alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! session('message')['content'] !!}
                </div>
            @endif

            @if (Session::get('errors'))
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Fehler</h4>
                    <ul>
                        @foreach (Session::get('errors')->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </body>
</html>

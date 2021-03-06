<!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', "Lyon Street Graff") }}</title>
        <link rel="icon" href="{!! asset('/images/lyon.png') !!}"/>
        <link rel="manifest" href="{!! asset('manifest.json') !!}">;
    <script>;
        if('serviceWorker' in navigator) {
          navigator.serviceWorker
                   .register('./serviceworker.js')
                   .then(function() { console.log("Service Worker Registered"); });
        }
        </script>;
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('css')
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>
    <body>
    
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        
        <a  class="navbar-brand" href="{{ route('home') }}"><img src="{!! asset('/images/flags/logo.png') !!}" width="%"> 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
            <li class="nav-item dropdown">
        
        <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('images/flags/' . session('locale') . '-flag.png') !!}" />
        </a>
        
        <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
            @foreach(config('app.locales') as $locale)
                @if($locale != session('locale'))
                    <a class="dropdown-item" href="{{ route('language', $locale) }}">
                        <img width="32" height="32" alt="{{ session('locale') }}"  src="{!! asset('images/flags/' . $locale . '-flag.png') !!}" />
                    </a>
                @endif
            @endforeach
        </div>
    </li>
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle
        @isset($category)
            {{ currentRoute(route('category', $category->slug)) }}
        @endisset
            " href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('| Oeuvres par catégorie ')
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
        @foreach($categories as $category)
            <a class="dropdown-item" href="{{ route('category', $category->slug) }}">{{ $category->name }}
            </a>
        @endforeach
    </div>
</li>

            @admin
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle{{ currentRoute(
                route('category.create'),
                route('category.index'),
                route('category.edit', request()->category?:0)
            )}}" href="#" id="navbarDropdownGestCat" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang(' | Administration')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownGestCat">
            <a class="dropdown-item" href="{{ route('category.create') }}">
                <i class="fas fa-plus fa-lg"></i> @lang('| Ajouter une catégorie')
            </a>

            <a class="dropdown-item" href="{{ route('category.index') }}">
                <i class="fas fa-wrench fa-lg"></i> @lang('| Gérer les catégories')
            </a>

            <a class="dropdown-item" href="{{ route('maintenance.index') }}">
                <i class="fas fa-cogs fa-lg"></i> @lang('| Maintenance')
            </a>

        </div>
    </li>
    @endadmin
                @auth
                    <li class="nav-item{{ currentRoute(route('image.create')) }}">
                     <a class="nav-link" href="{{ route('image.create') }}">@lang('| Ajouter une oeuvre ')
                     </a>
                    </li>
                @endauth
                @auth
                    <li class="nav-item{{ currentRoute(route('locations')) }}">
                        <a class="nav-link"href="{{ route('locations') }}">@lang('| Carte des oeuvres ')
                        </a>
                    </li>
                @endauth
              
    </li>

               
               
          
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item{{ currentRoute(route('login')) }}"><a class="nav-link" href="{{ route('login') }}">@lang('| Connexion')</a></li>
                    <li class="nav-item{{ currentRoute(route('register')) }}"><a class="nav-link" href="{{ route('register') }}">@lang('| Inscription')</a></li>
                    @else
                    <li class="nav-item{{ currentRoute(route('profile.edit', auth()->id())) }}"><a class="nav-link" href="{{ route('profile.edit', auth()->id()) }}">@lang('| Profil |')</a></li>
                    <li class="nav-item">
                        <a id="logout" class="nav-link" href="{{ route('logout') }}">@lang('Déconnexion')</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    @if (session('ok'))
        <div class="container">
            <div class="alert alert-dismissible alert-success fade show" role="alert">
                {{ session('ok') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    


    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <script>
        $(function() {
            $('#logout').click(function(e) {
                e.preventDefault();
                $('#logout-form').submit()
            })
        })
    </script>
      <!-- Footer -->
<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2018 Copyright:
  <a href="https://mdbootstrap.com/bootstrap-tutorial/"> Wasp</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
    </body>
    </html>
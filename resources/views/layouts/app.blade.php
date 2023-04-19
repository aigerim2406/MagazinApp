<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.nam', 'PandoraMe') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav style="background: #cc99cd" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="https://triniti-grodno.by/assets/images/2-etazh/Pandora/a43e964079b30f3541322bb24f87a2fe.jpg" style="width: 50px ; height: 35px">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.nam', 'PandoraMe') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="nav-link" href="{{route('shops.index')}}" >{{__('messages.Home')}}</a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        @isset($categories)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{__('messages.Category:') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @foreach($categories as $cat)
                                        <a class="nav-link" href="{{route('shops.category',$cat->id )}}">
                                            {{ $cat->{'name_'.app()->getLocale()} }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endisset
                    </ul>

                    <br><br><br><br>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login.form') }}">{{ __('messages.Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register.form') }}">{{ __('messages.Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role->name == 'user')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('shops.carts')}}">{{ __('messages.Shopping Cart')}}</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="https://instagram.com/pandora__kazakhstan?igshid=ZmRlMzRkMDU=">{{ __('messages.Contact.')}}</a>
                            </li>

                            <img src="{{Auth::user()->image}}" style="width: 43px; height: 43px" class="rounded-circle">

                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('shop.user')}}">{{__('messages.My Office')}}</a>
                                    @can('viewAny', \App\Models\Role::class)
                                        <a class="dropdown-item" href="{{route('adm.users.index')}}">{{__('messages.go to admin panel')}}</a>
                                    @endcan
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('messages.Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                            </li>

                            @if(Auth::user()->role->name == 'user')
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{__('messages.your shot:')}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <h3 class="dropdown-item">
                                            <span class=" bg-white">{{Auth::user()->shot}} ₸</span>
                                        </h3>
                                        <a class="dropdown-item" href="{{route('shops.shoot')}}">{{__('messages.Shot')}}</a>
                                    </div>
                                </li>
                            @endif
                        @endguest

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ config('app.languages')[app()->getLocale()] }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @foreach(config('app.languages') as $ln => $lang)
                                    <a class="dropdown-item" href="{{route('switch.lang', $ln)}}">
                                        {{$lang}}
                                    </a>
                                @endforeach
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        @if(session('message'))
            <div class="alert alert-warning" role="alert">
                {{session('message')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>

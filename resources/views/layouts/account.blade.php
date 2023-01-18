<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/main.css', 'resources/js/app.js'])
        
        @stack('styles')
        @livewireStyles
    </head>
    <body>

        <header x-data="{ open: false }">
            <div class="container">
                <a 
                    class="header-burger" 
                    role="button" 
                    aria-label="menu" 
                    aria-expanded="false" 
                    @click="open=!open" :class="!open || 'header-burger--active'"
                >
                    <span></span>
                </a>
            </div>
            <div class="header-nav" :class=" !open || 'header-nav--active' ">
                <div class="container container--sticky">
                    <div class="header-nav__box">
                        <ul>
                            <li><a href="{{ route('home') }}">Вернуться на сайт</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Личные данные</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit">{{ __('Logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            @include('layouts.partials.footer-copy')
        </footer>

        @stack('scripts')
        @livewireScripts
    </body>
</html>

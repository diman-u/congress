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
    </head>
    <body>

        <header x-data="{ open: false }">
            <div class="container">
                <div class="flex flex--ma pt-1 pb-1">
                    @yield('header-top', View::make('layouts.partials.header-top'))

                    <a 
                        class="header-burger" 
                        role="button" 
                        aria-label="menu" 
                        aria-expanded="false" 
                        @click="open = !open" :class=" !open || 'header-burger--active' "
                    >
                        <span></span>
                    </a>
                </div>
            </div>
            <div class="header-nav" :class=" !open || 'header-nav--active' ">
                <div class="container container--sticky">
                    <div class="header-nav__box">
                        @yield('header-nav', View::make('layouts.partials.header-nav'))
                    </div>
                </div>
            </div>
        </header>

        <main class="{{ !empty($main_class) ? $main_class : '' }}">
            @yield('content')
        </main>

        <footer>
            @include('layouts.partials.footer-main')
            @include('layouts.partials.footer-copy')
        </footer>
    </body>
</html>

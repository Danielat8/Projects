<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>
    <header class="header">
        <div class="header-container">
            @if (Route::has('login'))
            <nav class="nav">
                @auth
                <div class="nav-links">
                    <a href="{{ route('user.userpanel') }}" class="nav-link {{ request()->routeIs('user.userpanel') ? 'active' : '' }}">
                        {{ __('Panel') }}
                    </a>
                </div>
                @else
                <a href="{{ route('login') }}" class="nav-button">
                    Log in
                </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-button" style="margin-right: 100px;">
                    Register
                </a>
                @endif
                @endauth
            </nav>
            @endif
        </div>
    </header>
</body>

</html>
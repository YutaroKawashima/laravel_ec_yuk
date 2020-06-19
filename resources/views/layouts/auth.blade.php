<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title> {{ config('app.name', 'ECサイト') }} </title>
        <link rel = "stylesheet" href = "{{ asset('/css/style_auth.css') }}">
    </head>
    <body>
    <header>
        <div class = "item-area height-70px">
            <a href = "{{ url('top') }}">
                <img class = "logo" src = "{{ asset('./storage/images/shop-logo.png') }}" alt = "CodeSHOP">
            </a>
            @guest
                <a href="{{ url('register') }}" class="menu-item direct-R">
                    Register
                </a>
                <a href="{{ url('login') }}" class="menu-item direct-L">
                    Login
                </a>
            @else
                <form method="post" action="{{ url('logout') }}" class="menu-item">
                    {{ csrf_field() }}
                    <button type="submit" class = "menu-item logout">
                        ログアウト
                    </button>
                </form>
            @endguest
        </div>
    </header>

    @yield('content')

    </body>
</html>

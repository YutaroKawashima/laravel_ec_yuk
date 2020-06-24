<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title> @yield('title') </title>
        <link rel = "stylesheet" href = "{{ asset('css/style.css') }}">
    </head>
    <body>
    <header>
        <div class = "item-area height-70px">
            <a href = "{{ url('top') }}">
                <img class = "logo" src = "{{ asset('./storage/images/shop-logo.png') }}" alt = "CodeSHOP">
            </a>
            <form method="post" action="{{ url('logout') }}">
                {{ csrf_field() }}
                <button type="submit" class = "menu-item logout">
                    ログアウト
                </button>
            </form>

            <a class = "menu-item cart" href = "{{ url('cart') }}">
                <img src = "{{ asset('./storage/images/cart.png') }}" alt = "cart">
            </a>

            <p class = "menu-item">ユーザー名：{{ Auth::user()->name }}</p>
        </div>
    </header>

    @yield('content')

    </body>
</html>

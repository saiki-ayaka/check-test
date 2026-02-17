<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ContactForm-CheckTest</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rokkitt:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    @if(!Request::is('thanks'))
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>

            <nav class="header__nav">
                @if(Request::is('register'))
                    <a class="header__login-btn" href="{{ route('login') }}">login</a>
                @elseif(Request::is('login'))
                    <a class="header__register-btn" href="{{ route('register') }}">register</a>
                @elseif(Auth::check())
                    <form action="/logout" method="post">
                        @csrf
                        <button class="header__logout-btn" type="submit">logout</button>
                    </form>
                @endif
            </nav>
        </div>
    </header>
    @endif
    <main>
        @yield('content')
    </main>
</body>

</html>
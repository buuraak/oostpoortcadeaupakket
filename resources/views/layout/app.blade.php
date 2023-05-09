<!doctype html>
<html lang="nl">
<head>
    @include('includes.head')
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
<div>
    <div class="header">
        @include('includes.header')
    </div>

    <div id="app">
        @yield('content')
    </div>

    <footer class="footer py-5 px-3">
        @include('includes.footer')
    </footer>
    <div class="sub-footer py-4 px-3">
        <div class="container-lg">
            <div class="row justify-content-between">
                <div class="col-6">
                    <span class="white">© Winkelcentrum Oostpoort</span>
                </div>
                <div class="col-6">
                    <div class="float-right flex align-items-center">
                        <a class="link-unstyled" href="">Cookiebeleid</a>
                        <span class="white">|</span>
                        <a class="link-unstyled" href="">Privacy statement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script defer src="{{ mix('js/app.js') }}"></script>
</body>
</html>

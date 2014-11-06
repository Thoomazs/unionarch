<!DOCTYPE html>

<html lang="cs">
    <head>
        @include('site.layouts.partials.head')
    </head>
    <body class="{{ str_replace('.','-',Route::currentRouteName()) }}">
        @include('site.layouts.partials.messages')

         <div class="container">
            <header id="header">
                @include('site.layouts.partials.header')
            </header>


            <div id="content">
                @yield('content')
            </div>


            <footer id="footer">
                @include('site.layouts.partials.footer')
            </footer>
          </div>
    </body>
</html>
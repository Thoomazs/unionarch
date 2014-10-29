<div id="header-title">
    <div class="container">

        <a href="{{{ route('home') }}}">
            <h1 class="pull-left">

                <i class="fa fa-cube"></i> Starter App
                <span class="muted">/ laravel 5 application</span>

            </h1>
        </a>

{{--        @include('site.includes.localization')--}}

    </div>
</div>

<nav id="header-nav" class="navbar navbar-default navbar-static-top">

    <div class="container">

        <ul class="nav navbar-nav">
            @section('nav')
                <li class="{{ ( controller() == 'Products' ? 'active' : '' ) }}">
                    <a href="{{{ route('products.index') }}}">{{ trans('Products') }}</a>
                </li>
            @show
        </ul>

        <ul class="nav navbar-nav pull-right">
            @section('nav-right')

                @if (Auth::check())

                    @if( Auth::user()->hasRole('Admin') )
                        <li>
                            <a href="{{{ route('admin') }}}">{{ trans('Admin') }}</a>
                        </li>
                    @endif

                    <li class="{{ ( Request::url() == route('my-account.profile') ? ' active' : '') }}">
                        <a href="{{ route('my-account.profile') }}">{{{ Auth::user()->name }}}</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.logout') }}">{{ trans('Logout') }}</a>
                    </li>
                @else
                    <li class="{{ ( Request::url() == route('auth.login') ? ' active' : '') }}">
                        <a href="{{ route('auth.login') }}">{{ trans('Login') }}</a>
                    </li>
                    <li class="{{ ( Request::url() == route('auth.register') ? ' active' : '') }}">
                        <a href="{{ route('auth.register') }}">{{ trans('Register') }}</a>
                    </li>
                @endif

            @show
        </ul>
    </div>
</nav>
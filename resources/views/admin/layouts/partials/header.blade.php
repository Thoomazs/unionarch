<div class="container">

    <a class="navbar-brand" href="{{{ route('admin') }}}">
         ADMIN
    </a>

    <ul class="nav navbar-nav">
        @section('nav')

        <li class="dropdown {{ ( controller() == 'Users' ? 'active' : '' ) }}">
            <a href="{{ route('admin.users.index') }}" class="dropdown-toggle">
              {{ trans('Users') }}
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('admin.roles.index') }}"> {{ trans('Roles') }} </a>
                </li>
            </ul>
        </li>
        <li class="{{ (  controller() == 'Products' ? 'active' : '' ) }}">
            <a href="{{ route('admin.products.index') }}">{{ trans('Products') }}</a>
        </li>
         <li class="{{ (  controller() == 'Categories' ? 'active' : '' ) }}">
            <a href="{{ route('admin.categories.index') }}">{{ trans('Categories') }}</a>
        </li>

        @show
    </ul>

    <ul class="nav navbar-nav pull-right">
        <li class="{{ (  controller() == 'Log' ? 'active' : '' ) }}">
            <a href="{{ route('admin.log.index') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('Log') }}"><i class="fa fa-archive"></i></a>
        </li>
        <li class="{{ (  Request::url() == route('admin.settings') ? 'active' : '' ) }}">
            <a href="{{ route('admin.settings') }}" data-toggle="tooltip" data-placement="bottom"  title="{{ trans('Settings') }}"><i class="fa fa-cog"></i></a>
        </li>
        <li>
            <a href="{{ route('home') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('Back to the site') }}"><i class="fa fa-reply"></i></a>
        </li>
        <li>
            <a href="{{ route('auth.logout') }}" data-toggle="tooltip" data-placement="bottom" title="{{ trans('Logout') }}"><i class="fa fa-sign-out"></i></a>
        </li>
    </ul>
</div>

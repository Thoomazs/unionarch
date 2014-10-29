<!DOCTYPE html>
<html id="admin" lang="cs">
<head>
    @include('admin.layouts.partials.head')
</head>
<body class="{{ str_replace('.','-',Route::currentRouteName()) }}">


<header id="header">
    @include('admin.layouts.partials.header')
</header>


@include('admin.layouts.partials.messages')

<div id="main">
    <div class="container">
        @yield('content')
    </div>

</div>

</body>
</html>
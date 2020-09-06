<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.header')
<body>
    <div id="app">
        @if(request()->is('*user*') || request()->is('/'))
            @include('layouts.user.nav')
        @elseif(request()->is('company*'))
            @include('layouts.company.nav')
        @endif

        <main>
            @yield('content')
        </main>
    </div>
@include('layouts.footer')
</body>
</html>

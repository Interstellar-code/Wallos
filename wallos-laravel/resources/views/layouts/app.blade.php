<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="antialiased">
        @include('partials.header')
        <main class="container mx-auto px-4 py-8">
            @yield('content')
        </main>
        @include('partials.footer')
        @include('partials.scripts')
    </body>
    
    @auth
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
    @endauth
</html>
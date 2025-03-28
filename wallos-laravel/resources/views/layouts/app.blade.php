<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')
    <body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        @include('partials.header')
        <main>
            @yield('content')
        </main>
        @include('partials.footer')
        @include('partials.scripts')
        @stack('scripts')
    </body>
    
    @auth
    <form id="logout-form" method="POST" action="{{ route('auth.logout') }}" class="hidden">
        @csrf
    </form>
    @endauth
</html>
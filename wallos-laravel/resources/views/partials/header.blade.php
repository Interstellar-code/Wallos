<header>
    <div class="logo-image" title="Wallos - Subscription Tracker">
        @include('partials.logo')
    </div>
    @if(isset($title))
        <p>{{ $title }}</p>
    @endif
</header>
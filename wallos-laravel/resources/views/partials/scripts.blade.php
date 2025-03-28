<script type="text/javascript">
    window.update_theme_settings = "{{ $updateThemeSettings ?? false }}";
    window.colorTheme = "{{ $colorTheme ?? 'blue' }}";
    window.csrfToken = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('scripts/common.js') }}"></script>

<!-- Alpine.js for interactive components -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Theme toggle functionality -->
<script>
    // Check for dark mode preference
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Function to toggle dark mode
    function toggleDarkMode() {
        if (localStorage.theme === 'dark') {
            localStorage.theme = 'light';
            document.documentElement.classList.remove('dark');
        } else {
            localStorage.theme = 'dark';
            document.documentElement.classList.add('dark');
        }
    }
</script>

@stack('scripts')
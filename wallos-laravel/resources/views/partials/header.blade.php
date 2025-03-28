<header class="bg-white dark:bg-gray-800 shadow">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <div class="logo-image" title="Wallos - Subscription Tracker">
            @include('partials.logo')
        </div>
        
        <!-- User Menu -->
        @auth
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <span class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-10">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Profile
                </a>
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Settings
                </a>
                <hr class="my-1 border-gray-200 dark:border-gray-700">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Logout
                </a>
            </div>
        </div>
        @endauth
    </div>
</header>
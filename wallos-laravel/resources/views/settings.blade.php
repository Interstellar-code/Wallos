@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Application Settings</h1>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Display Settings</h2>
            
            @if(session('display_success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('display_success') }}</p>
                </div>
            @endif
            
            <form action="{{ route('settings.display') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Theme</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="theme" value="light" {{ Auth::user()->theme === 'light' ? 'checked' : '' }} class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Light</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="theme" value="dark" {{ Auth::user()->theme === 'dark' ? 'checked' : '' }} class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Dark</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="theme" value="system" {{ Auth::user()->theme === 'system' ? 'checked' : '' }} class="form-radio h-5 w-5 text-blue-600">
                            <span class="ml-2 text-gray-700 dark:text-gray-300">System Default</span>
                        </label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="accent_color" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Accent Color</label>
                    <select name="accent_color" id="accent_color" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="blue" {{ Auth::user()->accent_color === 'blue' ? 'selected' : '' }}>Blue</option>
                        <option value="green" {{ Auth::user()->accent_color === 'green' ? 'selected' : '' }}>Green</option>
                        <option value="red" {{ Auth::user()->accent_color === 'red' ? 'selected' : '' }}>Red</option>
                        <option value="purple" {{ Auth::user()->accent_color === 'purple' ? 'selected' : '' }}>Purple</option>
                        <option value="yellow" {{ Auth::user()->accent_color === 'yellow' ? 'selected' : '' }}>Yellow</option>
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Display Settings
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Currency Settings</h2>
            
            @if(session('currency_success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('currency_success') }}</p>
                </div>
            @endif
            
            <form action="{{ route('settings.currency') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="main_currency" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Main Currency</label>
                    <select name="main_currency" id="main_currency" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="USD" {{ Auth::user()->main_currency === 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                        <option value="EUR" {{ Auth::user()->main_currency === 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                        <option value="GBP" {{ Auth::user()->main_currency === 'GBP' ? 'selected' : '' }}>British Pound (GBP)</option>
                        <option value="CAD" {{ Auth::user()->main_currency === 'CAD' ? 'selected' : '' }}>Canadian Dollar (CAD)</option>
                        <option value="AUD" {{ Auth::user()->main_currency === 'AUD' ? 'selected' : '' }}>Australian Dollar (AUD)</option>
                        <option value="JPY" {{ Auth::user()->main_currency === 'JPY' ? 'selected' : '' }}>Japanese Yen (JPY)</option>
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Currency Settings
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Language Settings</h2>
            
            @if(session('language_success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('language_success') }}</p>
                </div>
            @endif
            
            <form action="{{ route('settings.language') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="language" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Language</label>
                    <select name="language" id="language" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="en" {{ Auth::user()->language === 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ Auth::user()->language === 'es' ? 'selected' : '' }}>Spanish</option>
                        <option value="fr" {{ Auth::user()->language === 'fr' ? 'selected' : '' }}>French</option>
                        <option value="de" {{ Auth::user()->language === 'de' ? 'selected' : '' }}>German</option>
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Language Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
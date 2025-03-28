@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Profile Settings</h1>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username', Auth::user()->username) }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Change Password</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Leave password fields empty if you don't want to change it.</p>
                    
                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">New Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
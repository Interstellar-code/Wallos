@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Your Subscriptions</h1>
        <a href="{{ route('subscriptions.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add Subscription
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if(count($subscriptions) > 0)
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Billing Cycle
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Next Payment
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($subscriptions as $subscription)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $subscription->name }}
                                </div>
                                @if($subscription->description)
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                        {{ $subscription->description }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ $subscription->currency }} {{ number_format($subscription->amount, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white capitalize">
                                    {{ $subscription->billing_cycle }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    {{ date('M d, Y', strtotime($subscription->next_payment_date)) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('subscriptions.show', $subscription) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                                        View
                                    </a>
                                    <a href="{{ route('subscriptions.edit', $subscription) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="flex flex-col items-center justify-center min-h-[40vh]">
            <!-- Illustration -->
            <div class="mb-8">
                <img src="{{ asset('images/illustrations/empty-state.svg') }}" alt="No subscriptions" class="w-64 h-64">
                @if(!file_exists(public_path('images/illustrations/empty-state.svg')))
                <!-- Fallback illustration if the SVG doesn't exist -->
                <div class="w-64 h-64 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full text-blue-500">
                        <circle cx="12" cy="8" r="7"></circle>
                        <path d="M12 15 L12 22"></path>
                        <path d="M9 18 L15 18"></path>
                    </svg>
                </div>
                @endif
            </div>
            
            <!-- Message -->
            <h2 class="text-2xl font-semibold text-center mb-6">You don't have any subscriptions yet</h2>
            
            <!-- Add subscription button -->
            <a href="{{ route('subscriptions.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add first subscription
            </a>
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Subscription Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('subscriptions.edit', $subscription) }}" class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $subscription->name }}</h2>
                        @if($subscription->description)
                            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $subscription->description }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $subscription->currency }} {{ number_format($subscription->amount, 2) }}
                        </div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 capitalize">
                            {{ $subscription->billing_cycle }}
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Next Payment Date</dt>
                            <dd class="mt-1 text-gray-900 dark:text-white">{{ date('F d, Y', strtotime($subscription->next_payment_date)) }}</dd>
                        </div>
                        
                        @if($subscription->plan)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Plan</dt>
                            <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->plan->name }}</dd>
                        </div>
                        @endif
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                            <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->created_at->format('F d, Y') }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                            <dd class="mt-1 text-gray-900 dark:text-white">{{ $subscription->updated_at->format('F d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
                
                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Payment Schedule</h3>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-md p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Next Payment</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ date('F d, Y', strtotime($subscription->next_payment_date)) }}</span>
                        </div>
                        
                        @php
                            $futureDate = strtotime($subscription->next_payment_date);
                            $cycle = $subscription->billing_cycle;
                            
                            // Calculate future payment dates based on billing cycle
                            $futureDates = [];
                            for ($i = 1; $i <= 3; $i++) {
                                if ($cycle == 'daily') {
                                    $futureDate = strtotime('+1 day', $futureDate);
                                } elseif ($cycle == 'weekly') {
                                    $futureDate = strtotime('+1 week', $futureDate);
                                } elseif ($cycle == 'monthly') {
                                    $futureDate = strtotime('+1 month', $futureDate);
                                } elseif ($cycle == 'yearly') {
                                    $futureDate = strtotime('+1 year', $futureDate);
                                } else {
                                    // Custom cycle, just add a month as placeholder
                                    $futureDate = strtotime('+1 month', $futureDate);
                                }
                                $futureDates[] = date('F d, Y', $futureDate);
                            }
                        @endphp
                        
                        @foreach($futureDates as $index => $date)
                            <div class="flex justify-between items-center {{ $index < count($futureDates) - 1 ? 'mb-2' : '' }}">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Payment {{ $index + 2 }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-300">{{ $date }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <form action="{{ route('subscriptions.destroy', $subscription) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subscription?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete Subscription
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
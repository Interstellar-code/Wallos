@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Subscription</h1>
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Please fix the following errors:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('subscriptions.update', $subscription) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $subscription->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Description (Optional)</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description', $subscription->description) }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="amount" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Amount</label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', $subscription->amount) }}" step="0.01" min="0" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                    
                    <div>
                        <label for="currency" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Currency</label>
                        <select name="currency" id="currency" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="USD" {{ old('currency', $subscription->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency', $subscription->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency', $subscription->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                            <option value="CAD" {{ old('currency', $subscription->currency) == 'CAD' ? 'selected' : '' }}>CAD</option>
                            <option value="AUD" {{ old('currency', $subscription->currency) == 'AUD' ? 'selected' : '' }}>AUD</option>
                            <option value="JPY" {{ old('currency', $subscription->currency) == 'JPY' ? 'selected' : '' }}>JPY</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="billing_cycle" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Billing Cycle</label>
                        <select name="billing_cycle" id="billing_cycle" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="daily" {{ old('billing_cycle', $subscription->billing_cycle) == 'daily' ? 'selected' : '' }}>Daily</option>
                            <option value="weekly" {{ old('billing_cycle', $subscription->billing_cycle) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ old('billing_cycle', $subscription->billing_cycle) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ old('billing_cycle', $subscription->billing_cycle) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            <option value="custom" {{ old('billing_cycle', $subscription->billing_cycle) == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="next_payment_date" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Next Payment Date</label>
                        <input type="date" name="next_payment_date" id="next_payment_date" value="{{ old('next_payment_date', $subscription->next_payment_date) }}" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>
                </div>
                
                @if(isset($plans) && count($plans) > 0)
                <div class="mb-6">
                    <label for="plan_id" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">Plan (Optional)</label>
                    <select name="plan_id" id="plan_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">No Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_id', $subscription->plan_id) == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('subscriptions.show', $subscription) }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Subscription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
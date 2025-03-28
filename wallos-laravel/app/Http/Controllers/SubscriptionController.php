<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the subscriptions.
     */
    public function index()
    {
        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new subscription.
     */
    public function create()
    {
        $plans = Plan::all();
        return view('subscriptions.create', compact('plans'));
    }

    /**
     * Store a newly created subscription in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'billing_cycle' => 'required|string|in:daily,weekly,monthly,yearly,custom',
            'next_payment_date' => 'required|date',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        $subscription = new Subscription();
        $subscription->name = $validated['name'];
        $subscription->description = $validated['description'] ?? null;
        $subscription->amount = $validated['amount'];
        $subscription->currency = $validated['currency'];
        $subscription->billing_cycle = $validated['billing_cycle'];
        $subscription->next_payment_date = $validated['next_payment_date'];
        $subscription->plan_id = $validated['plan_id'] ?? null;
        $subscription->user_id = auth()->id();
        $subscription->save();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified subscription.
     */
    public function show(Subscription $subscription)
    {
        $this->authorize('view', $subscription);
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit(Subscription $subscription)
    {
        $this->authorize('update', $subscription);
        $plans = Plan::all();
        return view('subscriptions.edit', compact('subscription', 'plans'));
    }

    /**
     * Update the specified subscription in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $this->authorize('update', $subscription);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'billing_cycle' => 'required|string|in:daily,weekly,monthly,yearly,custom',
            'next_payment_date' => 'required|date',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        $subscription->update($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified subscription from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
}
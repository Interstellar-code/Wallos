<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FilterMenu extends Component
{
    public $members = [];
    public $categories = [];
    public $paymentMethods = [];
    public $settings = [];
    public $selectedMembers = [];
    public $selectedCategories = [];
    public $selectedPayments = [];
    public $selectedState = null;
    public $selectedRenewalType = null;

    public function mount()
    {
        // Initialize with data from session or database
        $this->loadFilters();
    }

    public function loadFilters()
    {
        // Load filter data - this should be replaced with actual data loading logic
        $this->members = Auth::user()->householdMembers ?? [];
        $this->categories = Auth::user()->categories ?? [];
        $this->paymentMethods = Auth::user()->paymentMethods ?? [];
        $this->settings = Auth::user()->settings ?? [];
    }

    public function updatedSelectedMembers()
    {
        $this->emit('filtersUpdated', [
            'members' => $this->selectedMembers,
            'categories' => $this->selectedCategories,
            'payments' => $this->selectedPayments,
            'state' => $this->selectedState,
            'renewal_type' => $this->selectedRenewalType
        ]);
    }

    public function updatedSelectedCategories()
    {
        $this->emit('filtersUpdated', [
            'members' => $this->selectedMembers,
            'categories' => $this->selectedCategories,
            'payments' => $this->selectedPayments,
            'state' => $this->selectedState,
            'renewal_type' => $this->selectedRenewalType
        ]);
    }

    public function updatedSelectedPayments()
    {
        $this->emit('filtersUpdated', [
            'members' => $this->selectedMembers,
            'categories' => $this->selectedCategories,
            'payments' => $this->selectedPayments,
            'state' => $this->selectedState,
            'renewal_type' => $this->selectedRenewalType
        ]);
    }

    public function updatedSelectedState()
    {
        $this->emit('filtersUpdated', [
            'members' => $this->selectedMembers,
            'categories' => $this->selectedCategories,
            'payments' => $this->selectedPayments,
            'state' => $this->selectedState,
            'renewal_type' => $this->selectedRenewalType
        ]);
    }

    public function updatedSelectedRenewalType()
    {
        $this->emit('filtersUpdated', [
            'members' => $this->selectedMembers,
            'categories' => $this->selectedCategories,
            'payments' => $this->selectedPayments,
            'state' => $this->selectedState,
            'renewal_type' => $this->selectedRenewalType
        ]);
    }

    public function clearFilters()
    {
        $this->reset([
            'selectedMembers',
            'selectedCategories',
            'selectedPayments',
            'selectedState',
            'selectedRenewalType'
        ]);
        
        $this->emit('filtersUpdated', [
            'members' => [],
            'categories' => [],
            'payments' => [],
            'state' => null,
            'renewal_type' => null
        ]);
    }

    public function render()
    {
        return view('livewire.components.filter-menu');
    }
}

<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SortOptions extends Component
{
    public $sortOrder = 'name';
    public $settings = [];

    public function mount($initialSort = 'name', $settings = [])
    {
        $this->sortOrder = $initialSort;
        $this->settings = $settings;
    }

    public function setSortOption($option)
    {
        $this->sortOrder = $option;
        $this->emit('sortChanged', $this->sortOrder);
    }

    public function render()
    {
        return view('livewire.components.sort-options');
    }
}

<div class="sort-options">
    <ul>
        <li class="{{ $sortOrder == 'name' ? 'selected' : '' }}" 
            wire:click="setSortOption('name')">
            {{ __('name') }}
        </li>
        <li class="{{ $sortOrder == 'id' ? 'selected' : '' }}" 
            wire:click="setSortOption('id')">
            {{ __('last_added') }}
        </li>
        <li class="{{ $sortOrder == 'price' ? 'selected' : '' }}" 
            wire:click="setSortOption('price')">
            {{ __('price') }}
        </li>
        <li class="{{ $sortOrder == 'next_payment' ? 'selected' : '' }}" 
            wire:click="setSortOption('next_payment')">
            {{ __('next_payment') }}
        </li>
        <li class="{{ $sortOrder == 'payer_user_id' ? 'selected' : '' }}" 
            wire:click="setSortOption('payer_user_id')">
            {{ __('member') }}
        </li>
        <li class="{{ $sortOrder == 'category_id' ? 'selected' : '' }}" 
            wire:click="setSortOption('category_id')">
            {{ __('category') }}
        </li>
        <li class="{{ $sortOrder == 'payment_method_id' ? 'selected' : '' }}" 
            wire:click="setSortOption('payment_method_id')">
            {{ __('payment_method') }}
        </li>
        @if(!isset($settings['hideDisabledSubscriptions']) || $settings['hideDisabledSubscriptions'] !== 'true')
            <li class="{{ $sortOrder == 'inactive' ? 'selected' : '' }}" 
                wire:click="setSortOption('inactive')">
                {{ __('state') }}
            </li>
        @endif
        <li class="{{ $sortOrder == 'alphanumeric' ? 'selected' : '' }}" 
            wire:click="setSortOption('alphanumeric')">
            {{ __('alphanumeric') }}
        </li>
        <li class="{{ $sortOrder == 'renewal_type' ? 'selected' : '' }}" 
            wire:click="setSortOption('renewal_type')">
            {{ __('renewal_type') }}
        </li>
    </ul>
</div>

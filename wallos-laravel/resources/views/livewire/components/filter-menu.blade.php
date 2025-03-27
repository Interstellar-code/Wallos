<div class="filtermenu-content">
    @if(count($members) > 1)
        <div class="filtermenu-submenu">
            <div class="filter-title" wire:click="$toggle('showMemberFilters')">
                {{ __('member') }}
            </div>
            @if($showMemberFilters)
                <div class="filtermenu-submenu-content">
                    @foreach($members as $member)
                        @if($member['count'] > 0)
                            <div class="filter-item {{ in_array($member['id'], $selectedMembers) ? 'selected' : '' }}" 
                                 wire:click="toggleMemberFilter({{ $member['id'] }})">
                                {{ $member['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    @if(count($categories) > 1)
        <div class="filtermenu-submenu">
            <div class="filter-title" wire:click="$toggle('showCategoryFilters')">
                {{ __('category') }}
            </div>
            @if($showCategoryFilters)
                <div class="filtermenu-submenu-content">
                    @foreach($categories as $category)
                        @if($category['count'] > 0)
                            <div class="filter-item {{ in_array($category['id'], $selectedCategories) ? 'selected' : '' }}" 
                                 wire:click="toggleCategoryFilter({{ $category['id'] }})">
                                {{ $category['name'] == "No category" ? __('no_category') : $category['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    @if(count($paymentMethods) > 1)
        <div class="filtermenu-submenu">
            <div class="filter-title" wire:click="$toggle('showPaymentFilters')">
                {{ __('payment_method') }}
            </div>
            @if($showPaymentFilters)
                <div class="filtermenu-submenu-content">
                    @foreach($paymentMethods as $payment)
                        @if($payment['count'] > 0)
                            <div class="filter-item {{ in_array($payment['id'], $selectedPayments) ? 'selected' : '' }}" 
                                 wire:click="togglePaymentFilter({{ $payment['id'] }})">
                                {{ $payment['name'] }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    @if(!isset($settings['hideDisabledSubscriptions']) || $settings['hideDisabledSubscriptions'] !== 'true')
        <div class="filtermenu-submenu">
            <div class="filter-title" wire:click="$toggle('showStateFilters')">
                {{ __('state') }}
            </div>
            @if($showStateFilters)
                <div class="filtermenu-submenu-content">
                    <div class="filter-item {{ $selectedState === 0 ? 'selected' : '' }}" 
                         wire:click="setStateFilter(0)">
                        {{ __('enabled') }}
                    </div>
                    <div class="filter-item {{ $selectedState === 1 ? 'selected' : '' }}" 
                         wire:click="setStateFilter(1)">
                        {{ __('disabled') }}
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="filtermenu-submenu">
        <div class="filter-title" wire:click="$toggle('showRenewalFilters')">
            {{ __('renewal_type') }}
        </div>
        @if($showRenewalFilters)
            <div class="filtermenu-submenu-content">
                <div class="filter-item {{ $selectedRenewalType === 1 ? 'selected' : '' }}" 
                     wire:click="setRenewalTypeFilter(1)">
                    {{ __('auto_renewal') }}
                </div>
                <div class="filter-item {{ $selectedRenewalType === 0 ? 'selected' : '' }}" 
                     wire:click="setRenewalTypeFilter(0)">
                    {{ __('manual_renewal') }}
                </div>
            </div>
        @endif
    </div>

    @if(count(array_filter([$selectedMembers, $selectedCategories, $selectedPayments, $selectedState, $selectedRenewalType])) > 0)
        <div class="filtermenu-submenu">
            <div class="filter-title filter-clear" wire:click="clearFilters">
                <i class="fa-solid fa-times-circle"></i> {{ __('clear') }}
            </div>
        </div>
    @endif
</div>

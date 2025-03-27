<div class="theme-switcher">
    <div class="theme-toggle" wire:click="switchTheme">
        <i class="fa-solid {{ $theme === 'light' ? 'fa-moon' : 'fa-sun' }}"></i>
    </div>
    
    @if($showThemeOptions)
        <div class="theme-options">
            <div class="theme-option {{ $theme === 'light' ? 'active' : '' }}" 
                 wire:click="setTheme('light')">
                <i class="fa-solid fa-sun"></i> {{ __('light') }}
            </div>
            <div class="theme-option {{ $theme === 'dark' ? 'active' : '' }}" 
                 wire:click="setTheme('dark')">
                <i class="fa-solid fa-moon"></i> {{ __('dark') }}
            </div>
            
            <div class="color-themes">
                <div class="color-theme blue {{ $colorTheme === 'blue' ? 'active' : '' }}" 
                     wire:click="setColorTheme('blue')"></div>
                <div class="color-theme green {{ $colorTheme === 'green' ? 'active' : '' }}" 
                     wire:click="setColorTheme('green')"></div>
                <div class="color-theme purple {{ $colorTheme === 'purple' ? 'active' : '' }}" 
                     wire:click="setColorTheme('purple')"></div>
                <div class="color-theme red {{ $colorTheme === 'red' ? 'active' : '' }}" 
                     wire:click="setColorTheme('red')"></div>
            </div>
        </div>
    @endif
    
    <div class="theme-settings" wire:click="toggleThemeOptions">
        <i class="fa-solid fa-gear"></i>
    </div>
</div>

<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class ThemeSwitcher extends Component
{
    public $theme = 'light';
    public $colorTheme = 'blue';
    public $showThemeOptions = false;

    public function mount()
    {
        $this->theme = Cookie::get('theme', 'light');
        $this->colorTheme = Cookie::get('colorTheme', 'blue');
    }

    public function switchTheme()
    {
        $this->theme = $this->theme === 'light' ? 'dark' : 'light';
        Cookie::queue('theme', $this->theme, 60 * 24 * 365);
        $this->emit('themeChanged', $this->theme);
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
        Cookie::queue('theme', $this->theme, 60 * 24 * 365);
        $this->emit('themeChanged', $this->theme);
    }

    public function setColorTheme($color)
    {
        $this->colorTheme = $color;
        Cookie::queue('colorTheme', $this->colorTheme, 60 * 24 * 365);
        $this->emit('colorThemeChanged', $this->colorTheme);
    }

    public function toggleThemeOptions()
    {
        $this->showThemeOptions = !$this->showThemeOptions;
    }

    public function render()
    {
        return view('livewire.components.theme-switcher');
    }
}

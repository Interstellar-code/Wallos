<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Customize table name pluralization
        Str::plural('household', 1); // Force singular table name
        
        // Explicitly map morph names if needed
        Relation::enforceMorphMap([
            'household' => 'App\Models\Household',
        ]);
    }
}

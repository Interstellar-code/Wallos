# Wallos Translation Guide

## Using Translations in Blade Templates

To display translations in Blade templates, use the `__()` helper:

```php
// Simple translation
{{ __('messages.dashboard.subscription.error_reloading') }}

// Translation with parameters 
{{ __('validation.min.numeric', ['attribute' => 'price', 'min' => 5]) }}
```

## Using Translations in JavaScript

1. First, create a JSON file for each language in `resources/lang` (e.g., `en.json`)
2. Then use Laravel Mix to compile them:

```javascript
// In webpack.mix.js
mix.js('resources/js/app.js', 'public/js')
   .extractTranslations();
```

In your JavaScript:
```javascript
const message = __.get('messages.dashboard.subscription.error_reloading');
```

## Adding New Languages

1. Create a new directory in `resources/lang` (e.g., `es` for Spanish)
2. Copy the English files and translate them
3. Update `config/app.php` to add the new locale:

```php
'locales' => [
    'en' => 'English',
    'es' => 'Spanish',
],
```

## Best Practices

1. Keep translations organized by feature area
2. Use descriptive keys that indicate the context
3. Avoid concatenating translated strings
4. For dynamic content, use placeholders (e.g., `:count` items)
5. Regularly sync translations between languages
6. Use the `trans:status` Artisan command to check missing translations

## File Structure

```
resources/lang/
├── en/
│   ├── messages.php     # Application messages
│   ├── validation.php   # Validation messages
│   └── auth.php         # Authentication messages
├── es/                  # Spanish translations
│   ├── messages.php
│   ├── validation.php
│   └── auth.php
└── TRANSLATION_GUIDE.md # This file
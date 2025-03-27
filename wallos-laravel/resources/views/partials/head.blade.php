<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="theme-color" content="{{ isset($theme) && $theme == 'light' ? '#FFFFFF' : '#222222' }}" id="theme-color" />
<meta name="apple-mobile-web-app-title" content="Wallos">
<title>Wallos - Subscription Tracker</title>
<link rel="icon" type="image/png" href="{{ asset('images/icon/favicon.ico') }}" sizes="16x16">
<link rel="apple-touch-icon" href="{{ asset('images/icon/apple-touch-icon.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icon/apple-touch-icon-152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon/apple-touch-icon-180.png') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">
<link rel="stylesheet" href="{{ asset('styles/theme.css') }}">
<link rel="stylesheet" href="{{ asset('styles/login.css') }}">
<link rel="stylesheet" href="{{ asset('styles/themes/red.css') }}" id="red-theme" {{ !isset($colorTheme) || $colorTheme != 'red' ? 'disabled' : '' }}>
<link rel="stylesheet" href="{{ asset('styles/themes/green.css') }}" id="green-theme" {{ !isset($colorTheme) || $colorTheme != 'green' ? 'disabled' : '' }}>
<link rel="stylesheet" href="{{ asset('styles/themes/yellow.css') }}" id="yellow-theme" {{ !isset($colorTheme) || $colorTheme != 'yellow' ? 'disabled' : '' }}>
<link rel="stylesheet" href="{{ asset('styles/themes/purple.css') }}" id="purple-theme" {{ !isset($colorTheme) || $colorTheme != 'purple' ? 'disabled' : '' }}>
<link rel="stylesheet" href="{{ asset('styles/login-dark-theme.css') }}" id="dark-theme" {{ !isset($theme) || $theme == 'light' ? 'disabled' : '' }}>
<link rel="stylesheet" href="{{ asset('styles/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('styles/barlow.css') }}">
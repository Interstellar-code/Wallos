<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallos - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="content">
        <section class="container">
            <header>
                <div class="logo-text">
                    <h1>Wallos</h1>
                </div>
                <p>Please login</p>
            </header>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="form-group-inline">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Stay logged in</label>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
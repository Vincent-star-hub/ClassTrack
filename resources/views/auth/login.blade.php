<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Font Awesome for Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('img/classtrack_logo.png') }}" alt="ClassTrack Logo">
        </div>
        <div class="welcome-message">Welcome to ClassTrack</div>
        <div class="description">Log in to monitor and track your students effortlessly.</div>

        @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Sign in">
        </form>
    </div>
</body>

</html>
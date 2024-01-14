<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@100;200;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class='content'>

        <form method="POST" action="{{ route('tryLogin') }}" class='login'>
            @csrf

            @if(session('error'))
                <p class='message'>{{ session('error') }}</p>
            @endif

            <label for="username">Username:</label>
            <input type="text" name="username" placeholder='Username...' required>

            <br>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder='Password...' required>

            <br>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>

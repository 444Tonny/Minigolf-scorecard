<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@100;200;400;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <header></header>

        <!-- (A) SIDEBAR -->
        <div id="pgside">
      <!-- (A1) BRANDING OR USER -->
      <!-- LINK TO DASHBOARD OR LOGOUT -->
      <div id="pguser">
        <span class="txt">THE DUGOUT</span>
      </div>

      <!-- (A2) MENU ITEMS -->
      <a href="{{ route('adminGames') }}">
        <i class="ico">&#9858;</i>
        <i class="txt">Games</i>
      </a>
      <a href="{{ route('adminSponsors') }}">
        <i class="ico">&#9872;</i>
        <i class="txt">Sponsors</i>
      </a>
      <a href="{{ route('adminCredentials') }}" class="current">
        <i class="ico">&#9432;</i>
        <i class="txt">Credentials</i>
      </a>
      <a class='logout' href="{{ route('logout') }}">
        <i class="ico">&#9906;</i>
        <i class="txt">Logout</i>
      </a>
    </div>


    <!-- (B) MAIN -->
    <main id="pgmain">
      <h2>UPDATE PASSWORD</h2>
      @if(session('success'))
          <p class='message-success'>{{ session('success') }}</p>
      @endif

      @if(session('error'))
          <p class='message-error'>{{ session('error') }}</p>
      @endif

      <form method="POST" action="{{ route('passwordEdited') }}" id='credentials'>
        @csrf
        @method('PUT')
        <label class='labcredentials' for="current_password">Current Password:</label>
        <input class='inputcredentials' type="password" name="current_password" required>
        @error('current_password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>
        <label class='labcredentials' for="new_password">New Password:</label>
        <input class='inputcredentials' type="password" name="new_password" required>
        @error('new_password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>
        <label class='labcredentials' for="confirm_password">Confirm Password:</label>
        <input class='inputcredentials' type="password" name="confirm_password" required>
        @error('confirm_password')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <br>
        <button class='btncredentials' type="submit">Update</button>
    </form>
<!-- ... -->
    </main>

    <footer></footer>
</body>
</html>

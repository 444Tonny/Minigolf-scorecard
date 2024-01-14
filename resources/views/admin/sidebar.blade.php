<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@200;400;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <!-- (A) SIDEBAR -->
    <div id="pgside">
      <!-- (A1) BRANDING OR USER -->
      <!-- LINK TO DASHBOARD OR LOGOUT -->
      <div id="pguser">
        <span class="txt">THE DUGOUT</span>
      </div>

      <!-- (A2) MENU ITEMS -->
      <a href="{{ route('adminGames') }}" class="current">
        <i class="ico">&#9858;</i>
        <i class="txt">Games</i>
      </a>
      <a href="{{ route('adminSponsors') }}">
        <i class="ico">&#9872;</i>
        <i class="txt">Sponsors</i>
      </a>
      <a href="{{ route('adminCredentials') }}">
        <i class="ico">&#9432;</i>
        <i class="txt">Credentials</i>
      </a>
      <a class='logout' href="{{ route('logout') }}">
        <i class="ico">&#9906;</i>
        <i class="txt">Logout</i>
      </a>
    </div>
</body>
</html>

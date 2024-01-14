<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Sponsors</title>
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
      <a href="{{ route('adminSponsors') }}" class="current">
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


    <!-- (B) MAIN -->
    <main id="pgmain">
      <h2>SPONSORS</h2>

      <table class="sponsors">
        <thead>
          <tr>
            <th>HOLE#</th>
            <th>SPONSOR</th>
            <th>LINK</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0 ; $i < sizeof($allSponsors) ; $i++) { ?>
          <tr>
            <td>#{{ $allSponsors[$i]['hole_number'] }}</td>
            <td>{{ $allSponsors[$i]['text_sponsor'] }}</td>
            <td><a href="{{ empty($allSponsors[$i]['link_sponsor']) ? '#' : $allSponsors[$i]['link_sponsor'] }}">{{ empty($allSponsors[$i]['link_sponsor']) ? 'No link' : $allSponsors[$i]['link_sponsor'] }}</a></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>


      @if(session('success'))
          <p class='message-success'>{{ session('success') }}</p>
      @endif

      @if(session('error'))
          <p class='message-error'>{{ session('error') }}</p>
      @endif

      <form method="POST" action="{{ route('sponsorsEdited') }}" id='credentials'>
        @csrf
        @method('PUT')
        <label class='labhole'>Hole number:</label>
        <input type='number' class='inputcredentials' name="hole_number" min="1" max="18" required>
        <br>
        <label class='labcredentials'>Text Sponsor:</label>
        <input class='inputcredentials' name="text_sponsor" placeholder="Sponsor..." maxlength="40" required>
        <br>
        <label class='labcredentials'>Sponsor link:</label>
        <input class='inputcredentials' name="link_sponsor" placeholder="Link..." maxlength="250">

        <button class='btncredentials' type="submit">Update</button>
    </form>
</main>

    <footer></footer>
</body>
</html>

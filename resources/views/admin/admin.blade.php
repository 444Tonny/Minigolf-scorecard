<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css?v2') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@100;200;400;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <header></header>

    @extends('admin.layoutAdmin')

    @section('content')

    <!-- (B) MAIN -->
    <main id="pgmain">
      <h2>LAST GAMES</h2>

      <div class='headerlist'>
        <span class='hgameid'>GAME#</span>
        <span class='hgameid'>DATETIME</span>
      </div>

      <div class="gameslist">

        <?php 
          $i = 0;

          for($i = 0 ; $i < sizeof($gameId) ; $i++) {
        ?>
        <div class="element">
          <span class="gameid"><b>#</b>{{ $gameId[$i] }}</span>
          <div class='row'>
            
          <?php for($k = 0 ; $k < sizeof($allPlayerPairs[$i]) ; $k++) { ?>
            <div class="player">
              <span class="name">{{ $allPlayerPairs[$i][$k][0] }}</span>
              <span class="score">{{ $allPlayerPairs[$i][$k][1] }}</span>
            </div>
          <?php } ?>
          </div>
          <span class="date">{{ date("M. d, Y", strtotime($gameDatetime[$i])) }} <br> <b>{{ substr($gameDatetime[$i], 11, 5) }}</b></span>
        </div>

        <?php } ?>
      
        <div class="pagination">
          {{ $gameResult->links() }}
        </div>

      </div>

    </main>

    @endsection

    <footer></footer>
</body>
</html>

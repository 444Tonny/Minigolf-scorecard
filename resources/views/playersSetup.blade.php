<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number of players</title>
</head>
<body>
    @extends('layout')

    @section('content')
    <main>
        <div class="setup">
            <span class="text1">PLAYER SETUP</span>
            <span class="text2">Who's playing?</span>
            <form action="{{ route('namesSelected', ['numberOfPlayer' => $numberOfPlayer]) }}" method='POST'>
                @csrf

                @for ($i = 1; $i <= $numberOfPlayer; $i++)
                    <label for="">Enter the name of <b>Golfer {{ $i }}</b></label>
                    <input type="text" name="playerName{{ $i }}" placeholder="Golfer {{ $i }}" minlength="1" maxlength="14" required>
                @endfor

                <div class="form-buttons">
                    <input type='hidden' name='numberOfPlayer' value='{{ $numberOfPlayer }}'>
                    <a href="{{ route('selectNumber') }}" class='back'><b>&lsaquo;</b> GO BACK</a>
                    <button onclick=resetScores() class='go' type="submit">LET'S GO <b>&rsaquo;</b></button>
                </div>
            </form>
        </div>
    </main>
    @endsection

    <script>
        function resetScores()
        {
            localStorage.removeItem('scores');
            localStorage.removeItem('totalScores');
        }
    </script>

    <footer></footer>
</body>
</html>
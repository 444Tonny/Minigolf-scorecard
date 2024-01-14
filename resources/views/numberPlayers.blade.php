<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup players</title>
</head>
<body>
    @extends('layout')

    @section('content')
    <main>
        <div class="players-numbers">
            <span class="text1">Welcome</span>
            <span class="text2">How many people are playing today?</span>
            <form class="nbChoices" action="{{ route('numberSelected') }}" method='POST'>
                @csrf
                <button type='submit' value='1' class="nbPlayer" name="number_of_player">1</button>
                <button type='submit' value='2' class="nbPlayer" name="number_of_player">2</button>
                <button type='submit' value='3' class="nbPlayer" name="number_of_player">3</button>
                <button type='submit' value='4' class="nbPlayer" name="number_of_player">4</button>
                <button type='submit' value='5' class="nbPlayer" name="number_of_player">5</button>
            </form>
        </div>
    </main>
    @endsection

    <footer></footer>
</body>
</html>
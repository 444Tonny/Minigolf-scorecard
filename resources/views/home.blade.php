<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@200;400;500;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <header></header>

    <main>
        <div class="welcome">
            <img class="big-logo" src="{{ asset('img/thedugout_big.png') }}">
            <span class="text2">A place to <br> create memories</span>
            <a href="{{ route('selectNumber') }}" class="play">LET'S PLAY<b>&rsaquo;</b></a>
        </div>
    </main>

    <footer></footer>
</body>
</html>

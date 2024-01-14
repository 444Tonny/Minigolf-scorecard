<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The dugout</title>
    <link rel="stylesheet" href="{{ asset('css/layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
    <header>
        <img class="small-logo logo" src="{{ asset('img/new_logo_thedugout.png') }}">
        <button id="viewRules">VIEW RULES</button>
    </header>
    <div class='rules'>
        <div class='top'>
            <h3>Course Rules</h3>
            <button id='closeRules' class="close">&times;</button>
        </div>
        <span class="rules-content">
            <p class='single-rule'>
                <i class='text'>
                Play at your own risk
                </i>  
            </p>
            <p class='single-rule'>
                <i class='text'>
                No groups larger than five.
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                Six stroke limit per hole.
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                Everyone in a group must play their first shot before anyone plays their second shot. 
                Replace out of bound ball where it went out. Take one-stoke penalty.
                </i>    
            </p>
            <p class='single-rule'>
                <i class='text'>
                Ball resting against an obstruction may be moved six inches.
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                Ball hit by another ball is replaced where it was hit, no penalty.
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                Golf ball floats in water hazard. Use ball scooper or ask for assistance. Take one stroke penalty.
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                PLEASE WATCH YOUR STEP <br> AND ENJOY YOUR GAME
                </i>
            </p>
            <p class='single-rule'>
                <i class='text'>
                NO REFUNDS <br> (RAIN CHECKS ONLY!)
                </i>
            </p>
        </span>
        <div class='warnings'>
            <div>
                <img src="{{ asset('img/nosmoking.png') }}">
                <span class='warning-text'>NO SMOKING</span>
            </div>
            <div>
                <img src="{{ asset('img/nopet.png') }}">
                <span class='warning-text'>NO PETS</span>
            </div>
            <div>
                <img src="{{ asset('img/noclimbing.png') }}">
                <span class='warning-text'>NO CLIMBING ON ROCKS</span>
            </div>
        </div>
    </div>

    <script>
        // Open & Close rules window
        const viewRulesButton = document.getElementById('viewRules');
        const closeRulesButton = document.getElementById('closeRules');
        const rulesDiv = document.querySelector('.rules');

        viewRulesButton.addEventListener('click', () => {
            rulesDiv.style.display = 'flex';
        });

        closeRulesButton.addEventListener('click', () => {
            rulesDiv.style.display = 'none';
        });
    </script>
</body>
</html>
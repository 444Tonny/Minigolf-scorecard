<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Number of players</title>
    <!-- Assurez-vous d'inclure la bibliothèque html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.11.0/tsparticles.confetti.bundle.min.js"></script>
</head>

<body>
    @extends('layout')

    @section('content')
    <main>
        <!---------------------- HOLE PANEL  --------------------->
        <div id="board-info" class="board-info">
            <div class='hole-info'>
                <p>HOLE</p>
                <span id='holeNumber'>1</span> 
                <img id="wheelchair" class="wheelchair" src="{{ asset('img/wheelchair.png') }}">
            </div>
            <div class="par-info">
                <p>PAR</p>
                <span id='par' class='par'>3</span>
            </div>
            <div class="sponsor">
                <p>Sponsored by</p>
                <span id='sponsor'>Contact us</span>
            </div>
        </div>
        <div id='holePanel' class="hole">
            <form class='hole-form' method='POST'>
                @csrf
                @for ($i = 0; $i < sizeof($playerNames); $i++) 
                <div class="score-incrementor">
                    <label for="">{{ $playerNames[$i] }}</label>
                    <div class="incrementor">
                        <button type='button' class='minus'>−</button>
                        <input type="text" class='score' name="scoreP{{ $i - 1 }}" id="scoreP{{ $i }}" value='1'
                            autocomplete="off" readonly>
                        <button type='button' class='plus'>+</button>
                    </div>
                </div>
                @endfor
                <div class="form-buttons">
                    <button type='button' class='back redback' id='previous' onclick=goBack()><b>&lsaquo;</b> GO BACK</button>
                    <button type='button' class='go' id='next' onclick=nextHole()>GO TO HOLE 2<b>&rsaquo;</b></button>
                </div>
            </form>
        </div>

        <!--------------------------------- HOLE PANEL END  -------------------------------->


        <!--------------------------------- RESULT PANEL  -------------------------------->

        <div id="resultsPanel" class='resultsPanel'>
            <h5>Congratulations!</h5>
            <div class="resultsBox">
                <h4>The Dugout Mini Golf</h4>
                <span class="date" id='date'><?php echo date('M. j, Y', strtotime('today')); ?></span>
                <h6>Final Results</h6>
                <div class="winner playerResult" id='playerResult1'>
                    <span class="scoreWinner" id='scoreResult1'><b class='star'>&#9733;</b> 00 <b class='star'>&#9733;</b></span>
                    <span class="nameWinner" id='nameResult1'>XXX</span>
                </div>
                <div class="others">
                    <div class="playerResult" id='playerResult2'>
                        <span class="scoreOther" id='scoreResult2'>00</span>
                        <span class="nameOther" id='nameResult2'>XXX</span>
                    </div>
                    <div class="playerResult" id='playerResult3'>
                        <span class="scoreOther" id='scoreResult3'>00</span>
                        <span class="nameOther" id='nameResult3'>XXX</span>
                    </div>  
                    <div class="playerResult" id='playerResult4'>
                        <span class="scoreOther" id='scoreResult4'>00</span>
                        <span class="nameOther" id='nameResult4'>XXX</span>
                    </div>
                    <div class="playerResult" id='playerResult5'>
                        <span class="scoreOther" id='scoreResult5'>00</span>
                        <span class="nameOther" id='nameResult5'>XXX</span>
                    </div>  
                </div>
            </div>
            <p>Get the results!</p>
            <form action="">
                @csrf
                <input type="text" name="mail" id="mail" placeholder="Enter e-mail address">
                <button type='button' onclick="captureAndSend()">SEND <b>&rsaquo;</b></button>
            </form>
        </div>

        <div class='background-popup' id='background'>
            <div id="loading" style="display: none;">Please wait...</div>
            <div id="success" style="display: none;">
                <p class='success-title'>AWESOME!</p>
                <p class='message'>
                    Your results has been successfully sent.
                    <br>
                    Check your emails!
                </p>
                <button class='close-popup' onclick="hidePopup('success')">OK</button>
            </div>
            <div id="error" style="display: none;">
                <p class='error-title'>OOPS!</p>
                <p class='message'>
                    Please verify if your email address is correct
                    <br>
                    Then try again
                </p>
                <button class='close-popup' onclick="hidePopup('error')">OK</button>
            </div>
        </div>

        <script>
            const background = document.getElementById('background');

            function hidePopup(id)
            {
                background.style.display = 'none';
                document.getElementById(id).style.display = 'none';
                document.getElementById(id).classList.remove('show');
            }

            function showPopup(id)
            {
                console.log(document.getElementById(id));
                background.style.display = 'flex';
                document.getElementById(id).style.display = 'flex';
                document.getElementById(id).classList.add('show');
            }

            function captureAndSend() {

                let json_names = JSON.stringify(playerNames);
                let json_scores = JSON.stringify(totalScores);
                let mail = document.getElementById('mail').value;
                let date = document.getElementById('date').textContent;

                // Obtenir le jeton CSRF depuis la balise méta
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                showPopup('loading');
                showLoadingAnimation();

                // Envoi de l'image par Fetch au serveur avec le jeton CSRF
                fetch('/public/sendEmail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        names: json_names,
                        scores: json_scores,
                        mail: mail,
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Hide the loading spinner
                    document.getElementById('loading').style.display = 'none';
                    stopLoadingAnimation();

                    // Show success or error message based on the response
                    if (data.message === 'E-mail sent successfully') {
                        showPopup('success');
                    } else {
                        showPopup('error');
                    }
                })
                .catch(error => {
                    // Hide the loading spinner
                    document.getElementById('loading').style.display = 'none';
                    stopLoadingAnimation();

                    // Show the error message
                    showPopup('error');
                });
            }

            let isLoading = true; // Global flag to control the animation loop

            function stopLoadingAnimation() {
                isLoading = false;
            }

            function showLoadingAnimation() {
                isLoading = true;
                const loadingDots = document.getElementById('loading');

                // Start the animation using a timeout
                let frame = 0;
                const animate = () => {
                    if (!isLoading) {
                        // Stop the animation if the flag is false
                        return;
                    }

                    const dots = '...'.slice(0, frame);
                    loadingDots.textContent = `Please wait${dots}`;
                    frame = (frame + 1) % 4;
                    setTimeout(animate, 400); // Delay before the next animation frame
                };
                animate();
            }

        </script>


        <!--------------------------------- RESULT PANEL END -------------------------------->

        <div class='scorecard'>
            <div class="top moveToTopDiv">
                <p>SCORECARD</p>
                <button id='moveToTop'>Tap to expand<b>&lsaquo;</b></button>
            </div>
            <div class="current-scorecard">

                <div class='total-scores moveToTopDiv'>
                    @for ($i = 0 ; $i < sizeof($playerNames); $i++) 

                    <div class="total-player">
                        <span class='tdname'>{{ substr($playerNames[$i],0,4) }}</span>
                        <span class='sumScore' id='sumScoreValue{{ $i }}'>0</span>
                    </div>

                    @endfor
                </div>


                @for ($i = 1; $i <= sizeof($playerNames); $i++) <div class="player-table">
                <span class='name'>
                    {{ $playerNames[$i - 1] }}
                </span>
                <table>
                    <tr class='thead'>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td class='in-out'>IN</td>
                        <td class='total'>TOTAL</td>
                    </tr>
                    <tr class='values'>
                        @for ($k = 1 ; $k <= 9 ; $k++) <td id="holeN{{ $k }}P{{ $i }}">
                            </td>
                        @endfor
                        <td class='in-out' id='inP{{ $i }}'>0</td>
                        <td class='total'><i class='totalTable' style='font-style:normal;' id='totalTableP{{ $i }}'>0</i><i id='comparisonP{{ $i }}' class='parComparison'>+0</i></td>
                    </tr>
                    <tr class='thead'>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                        <td>17</td>
                        <td>18</td>
                        <td class='in-out'>OUT</td>
                    </tr>
                    <tr class='values'>
                        @for ($j = 10 ; $j <= 18 ; $j++) <td id="holeN{{ $j }}P{{ $i }}">
                            </td>
                            @endfor
                            <td class='in-out' id='outP{{ $i }}'>0</td>
                    </tr>
                </table>
            </div>
            @endfor

            </div>
        </div>
    </main>

    <script>
        // ScoreCard div positionement animation
        // Get a reference to the button and the scorecard div
        const moveToTopDiv = document.querySelectorAll('.moveToTopDiv');
        const moveToTopButton = document.getElementById('moveToTop');
        const scorecard = document.querySelector('.scorecard');
        let isScoreCardUp = false;

        // Add a click event listener to the button
        moveToTopDiv.forEach(element => {
            element.addEventListener('click', () => {

                if(isScoreCardUp == false)
                {
                    // Set the top position of the scorecard to 50px from the 
                    scorecard.classList.remove('move-to-bottom');
                    scorecard.classList.add('move-to-top');
                    isScoreCardUp = true;
                    moveToTopButton.innerHTML = 'Tap to close <b>&rsaquo;</b>';
                }
                else
                {
                    scorecard.classList.remove('move-to-top');
                    scorecard.classList.add('move-to-bottom');
                    isScoreCardUp = false;
                    moveToTopButton.innerHTML = 'Tap to expand <b>&lsaquo;</b>';
                }
            })
        })

        const sponsorHtml = document.getElementById('sponsor');
        const wheelchairIcon = document.getElementById('wheelchair');
        const parHtml = document.getElementById('par');
        const holeHtml = document.getElementById('holeNumber');
        const parArray = [2, 2, 3, 2, 2, 3, 2, 3, 2, 3, 2, 3, 3, 2, 2, 3, 2, 3];
        const wheelchairArray = [1,2,3,4,5,15,16,17,18];

        var allSponsors = <?php echo json_encode($allSponsors); ?>;
        var jsArraySponsors = [];

        // Copier les éléments du tableau PHP dans le tableau JavaScript
        for (var i = 0; i < allSponsors.length; i++) {
            jsArraySponsors.push(allSponsors[i]);
        }
        

        // Display the PAR, Sponsor count and Wheelcair icon for a specified Hole Number in HTML 
        function displayParCount(holeNumber) {
            var hrefAttribute = jsArraySponsors[holeNumber - 1].link_sponsor ? jsArraySponsors[holeNumber - 1].link_sponsor : "#";
            
            if(hrefAttribute == '#') 
            { 
                sponsorHtml.innerHTML = "<a class='sponsor_link' href='"+hrefAttribute+"' >" + jsArraySponsors[holeNumber - 1].text_sponsor + "</a>";
            }
            else 
            {
                sponsorHtml.innerHTML = "<a class='sponsor_link' href='"+hrefAttribute+"' target='_blank'>" + jsArraySponsors[holeNumber - 1].text_sponsor + "</a>";
            }

            // Show wheelchair if included in array
            if (wheelchairArray.includes(holeNumber)) wheelchairIcon.style.display = 'initial';
            else wheelchairIcon.style.display = 'none';

            parHtml.textContent = parArray[holeNumber - 1];
            scaleText(parHtml);
            scaleText(holeHtml);
        }

        // To sum PAR until the hole number needed (index)
        function sumParUntilIndex(index) {
            let sum = 0;

            for (let i = 0; i <= index; i++) {
                sum += parArray[i];
            }
            return sum;
        }

        function compareWithPar(parSum, playerSum) {
            if (parSum > playerSum) return '−' + (parSum - playerSum);
            else if (parSum < playerSum) return '+' + (playerSum - parSum);
            if (parSum == playerSum) return '+0';
        }

        // To store players score for each hole
        let scores = JSON.parse(localStorage.getItem('scores')) || [];

        // To store players total score summing points of each hole
        let totalScores = JSON.parse(localStorage.getItem('totalScores')) || [];

        // Current hole number
        let currentHole = 1;
        displayParCount(currentHole);

        // Player names
        var playerNames = '<?php echo json_encode($playerNames); ?>';
        playerNames = JSON.parse(playerNames);

        // Fill score inputs with previous data (if exist) after the page load 
        fillScoreInputs(currentHole);

        // Verify if previous data is stored (f.e.g in case user reloaded)
        if (scores[0] != undefined) {
            // Wait for the DOM to be fully loaded before summming score 
            document.addEventListener('DOMContentLoaded', function () {
                sumTotalScores();

                // Fill IN and OUT points 
                var a = 0;
                scores.forEach(score => {
                    fillScoreCard(currentHole + a, playerNames);
                    a++;
                });
            });
        }

        // Save scores per hole in an array
        function saveScores() {
            const scoreInputs = document.querySelectorAll('.score');
            let currentScores = [];

            scoreInputs.forEach(input => {
                currentScores.push(parseInt(input.value));
            });

            // Verify if this hole was already filled previously
            if (scores[currentHole - 1]) {
                // If yes, update it with the entered score
                scores.splice(currentHole - 1, 1, currentScores);
            } else {
                // If not, add new score
                scores.splice(currentHole - 1, 0, currentScores);
            }

            // Save scores in LocalStorage so user can reload page without losing data
            localStorage.setItem('scores', JSON.stringify(scores));

            fillScoreCard(currentHole, playerNames);
        }

        // Fill the points for each hole in the scorecard table
        function fillScoreCard(holeNumber, playerNames) {
            let i = 1;
            playerNames.forEach(player => {
                let id = ('holeN' + (holeNumber) + 'P' + i);
                let tdHole = document.getElementById(id);
                tdHole.textContent = scores[holeNumber - 1][i - 1]
                if(scores[holeNumber - 1][i - 1] == 1) tdHole.classList.add('oneShot');
                else tdHole.classList.remove('oneShot');
                i++;
            });
        }

        // Order array1 the same way as array2
        function customSort(arr1, arr2) {
            const combined = arr1.map((item, index) => [item, arr2[index]]);
            combined.sort((a, b) => a[1] - b[1]);
            const sortedArr1 = combined.map(item => item[0]);
            const sortedArr2 = combined.map(item => item[1]);
            return [sortedArr1, sortedArr2];
        }

        const nextButton = document.getElementById('next');

        // Fonction pour passer au trou suivant
        function nextHole() {
            // Save score and update the sum before going to next hole
            saveScores();
            sumTotalScores();

            // If it's the last hole, end gmae and display the results
            if(currentHole == 18)
            {   
                sum9Points('in');
                sum9Points('out');

                // Order scores and names array (1st - index 0, last - last index)
                [playerNames, totalScores] = customSort(playerNames, totalScores);
                
                // Obtenir le jeton CSRF depuis la balise méta
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let json_names = JSON.stringify(playerNames);
                let json_scores = JSON.stringify(totalScores);

                console.log(json_names);
                console.log(json_scores);

                fetch('/public/holes', {
                    method: 'POST', // Utilisez la méthode HTTP appropriée (POST, GET, etc.)
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        playerNames: json_names,
                        totalScores: json_scores
                    })
                })
                .then((response) => response.json())
                .then((data) => {
                    // Réponse du serveur (facultatif)
                    //console.log(data);
                })
                .catch((error) => {
                    // Gestion des erreurs (facultatif)
                    console.error("Erreur lors de la requête Fetch :", error);
                    //console.log(data);
                })

                for (let index = 0; index < playerNames.length; index++) {

                    if(index == 0) 
                    {
                        document.getElementById('scoreResult' + (index + 1)).innerHTML = "<b class='star'>&#9733;</b>" + totalScores[index] + "<b class='star'>&#9733;</b>";
                        document.getElementById('nameResult' + (index + 1)).textContent = playerNames[index];
                    }
                    else 
                    {
                        document.getElementById('scoreResult' + (index + 1)).textContent = totalScores[index];
                        document.getElementById('nameResult' + (index + 1)).textContent = playerNames[index].substring(0,4);
                    }
                    
                    document.getElementById('playerResult' + (index + 1)).style.display = 'flex';
                    document.getElementById('holePanel').style.display = 'none';
                    document.getElementById('board-info').style.display = 'none';
                    document.getElementById('resultsPanel').style.display = 'flex';
                }
                
                setTimeout(shootConfetti, 0);
                setTimeout(shootConfetti, 600);
                setTimeout(shootConfetti, 1200);
                setTimeout(shootConfetti, 1800);
                setTimeout(shootConfetti, 2400);
            }
            else
            {
                // Update current hole number on HTML
                currentHole++;
                const holeNumberElement = document.getElementById('holeNumber');
                holeNumberElement.textContent = currentHole;
                displayParCount(currentHole);

                // If next hole is the last, change text button
                if(currentHole == 18)
                {
                    nextButton.innerHTML = 'SHOW RESULTS<b>&rsaquo;</b>'
                }

                else nextButton.innerHTML = 'GO TO HOLE '+ (currentHole + 1) +' <b>&rsaquo;</b>'

                // Fill inputs of the next hole
                fillScoreInputs(currentHole);

                // SUM IN and OUT 
                sum9Points('in');
                sum9Points('out');
            }
        }

        const url = "{{ route('selectNumber') }}";

        // Go to the previous hole   
        function goBack() {

            nextButton.innerHTML = 'GO TO HOLE '+ (currentHole) +' <b>&rsaquo;</b>'

            if (currentHole > 1) {

                // Remove Show result if user click previous on last hole
                if(currentHole == 18) nextButton.innerHTML = 'GO TO HOLE '+ currentHole +' <b>&rsaquo;</b>'

                // Update current hole number on HTML
                currentHole--;
                const holeNumberElement = document.getElementById('holeNumber');
                holeNumberElement.textContent = currentHole;
                displayParCount(currentHole);

                // Fill inputs of the previous hole
                fillScoreInputs(currentHole);
            }
            else
            {
                // Redirect to players setup if it's the first hole
                window.location.href = url;
            }
        }

        // SUM IN or OUT (9 points)
        function sum9Points(inORout) {
            let inoutPoints = 0;

            let start = 0;
            let end = 9
            if (inORout == 'out') {
                start = 9;
                end = 18;
            }

            for (let i = 0; i < playerNames.length; i++) {
                if (scores[start] != undefined) {
                    for (let p = start; p < end; p++) {
                        if (scores[p] != undefined) {
                            inoutPoints += scores[p][i]
                        }
                    }
                }
                else break;

                document.getElementById(inORout + 'P' + (i + 1)).textContent = inoutPoints;
                inoutPoints = 0;
            }
        }

        // Function for summing values of numbers in the same index of each 2nd dimension tables
        function sumTotalScores() {
            const result = [];

            for (let i = 0; i < scores[0].length; i++) {
                let sum = 0;
                for (let j = 0; j < scores.length; j++) {
                    sum += scores[j][i];
                }
                result.push(sum);
            }

            totalScores = result;
            localStorage.setItem('totalScores', JSON.stringify(totalScores));

            // Compare TOTAL with the PAR
            let parSum = sumParUntilIndex(scores.length - 1);

            // Edit Html elements
            const sumScores = document.querySelectorAll('.sumScore');
            const sumScoresTable = document.querySelectorAll('.totalTable');
            const parComparison = document.querySelectorAll('.parComparison');

            let i = 0;
            sumScores.forEach(sumScore => {
                sumScore.textContent = totalScores[i];
                sumScoresTable[i].textContent = totalScores[i];
                parComparison[i].textContent = compareWithPar(parSum, totalScores[i]);
                i++;
            })
        }

        function fillScoreInputs(holeNumber) {
            const scoreInputs = document.querySelectorAll('.score');

            // Verify if hole have been previously filled
            if (scores[holeNumber - 1]) {
                let i = 0;
                scoreInputs.forEach(input => {
                    input.value = scores[holeNumber - 1][i];
                    i++;
                })
            }
            else {
                scoreInputs.forEach(input => {
                    input.value = '1';
                })
            }
        }

        // ------------------------- Plus and Minus Score buttons -------------------------

        // Adding event listener to buttons
        const incrementors = document.querySelectorAll('.score-incrementor .incrementor');
        incrementors.forEach((incrementor) => {

            const plusButton = incrementor.querySelector('.plus');
            const minusButton = incrementor.querySelector('.minus');
            const scoreInput = incrementor.querySelector('.score');
            let parLimit = 9; //parseInt(document.getElementById('par').textContent) * 3;



            plusButton.addEventListener('click', () => {
                const currentScore = parseInt(scoreInput.value);
                const newScore = currentScore + 1;
                if (newScore <= parLimit) {
                    scoreInput.value = newScore;
                    scaleText(scoreInput);
                }
            });

            minusButton.addEventListener('click', () => {
                const currentScore = parseInt(scoreInput.value);
                const newScore = currentScore - 1;
                if (newScore >= 0) {
                    scoreInput.value = newScore;
                    scaleText(scoreInput);
                }
            });
        });

        function scaleText(textToScale)
        {
            textToScale.style.transform = 'scale(1.3)';
  
            // Reset the scale after a short delay
            setTimeout(() => {
                textToScale.style.transform = 'scale(1)';
            }, 100);
        };

        /* ------------------------------ Animations & CONFETTI ---------------------------- */

        // Use JavaScript to add the "show" class to the div and trigger the animation
        const div = document.querySelector('.resultsBox');
        div.classList.add('show');

        const defaults = {
            spread: 360,
            ticks: 50,
            gravity: 0.3,
            decay: 0.95,
            startVelocity: 70,
            shapes: ["star"],
            colors: ["FFE400", "FFDB73", "ED8BA6", "FE3A70", "FDFFB8"],
            position: {
                'x': 50,
                'y': 0
            }
        };

        function shootConfetti() {
            confetti({
                ...defaults,
                particleCount: 10,
                scalar: 1.4,
                shapes: ["star"],
            });

            confetti({
                ...defaults,
                particleCount: 3,
                scalar: 0.8,
                shapes: ["circle"],
            });
            }
        </script>
    
    @endsection

    <footer>

    </footer>

</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Votre sujet d'e-mail</title>
    <style>
        /* Votre CSS personnalisé pour l'e-mail */
        body 
        {
            font-family: 'Ubuntu', Verdana, sans-serif;
        }
        .container {
            max-width: 520px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            background: white;
        }
        .resultsPanel
        {
            display: block;
            text-align: center;
        }

        .resultsPanel h5
        {
            margin: 20px auto 13px auto;
            text-align: center;
            font-size: 26px;
            font-weight: 700;
            color: #4F595E;
        }

        .resultsPanel div.resultsBox
        {
            margin: 0 auto;
            text-align: center;
            width: 400px;
            height: 330px;
            box-shadow: 0px 0px 10px 3px #dfdfdf;
            color: #A1AEB7;
            padding: 5px 0px 5px 0px;
            margin-bottom: 5px;
        }

        .resultsPanel div.resultsBox h4
        {
            font-weight: 700;
            font-size: 18px;
            margin: 0px auto 16px auto;
            color: #DF1A56;
        }

        .resultsPanel div.resultsBox h6
        {
            font-weight: 700;
            font-size: 18px;
            color: #555555;
            margin: 4px auto 6px auto;
        }

        .resultsPanel div.winner
        {
            text-align: center;
        }

        .resultsPanel span.scoreWinner
        {
            font-size: 55px;
            font-weight: 700;
            margin: 0 auto;
            text-align: center;
            display: block;
            color: #DF1A56;
        }

        .resultsPanel span.nameWinner
        {
            position: relative;
            top: -5px;
            font-size: 26px;
            font-weight: bold;
            color: #555555;
            position: relative;
            top: -3px;
        }

        b.star
        {
            font-size: 22px;
            margin: 0 17px;
            position: relative;
            top: -12px;
        }

        .resultsPanel div.others
        {
            margin-top: 20px;
            display: inline-flex;
            text-align: center;
            color: #555 !important;
        }

        .resultsPanel div.others div
        {
            text-align: center;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
            display: block;
        }

        .resultsPanel span.scoreOther
        {
            display: block;
            font-size: 34px;
            font-weight: 700;
        }

        .resultsPanel span.nameOther
        {
            position: relative;
            top: -8px;
            font-size: 17px;
            font-weight: 700;
            color: #4F595E;
        }

        div.adL
        {
            display: none !important;
        }

        h2
        {
            font-size: 16px;
            text-align: center;
        }

        h3
        {
            font-size: 14px;
            text-align: center;
        }

    </style>
</head>
<body>

    <h2>Here are your game results !</h2>

    <div class="container">
    <div id="resultsPanel" class='resultsPanel'>
            <h5>Congratulations!</h5>
            <div class="resultsBox">
                <h4>The Dugout Mini Golf</h4>
                <span class="date" id='date'>{{ $date }}</span>
                <h6>Final Results</h6>
                <div class="winner playerResult" id='playerResult1'>
                    <span class="scoreWinner" id='scoreResult1'><b class='star'>&#9733;</b> {{ $scores[0] }} <b class='star'>&#9733;</b></span>
                    <span class="nameWinner" id='nameResult1'>{{ $names[0] }}</span>
                </div>
                <div class="others">
                    @php
                        $combinedData = array_map(function ($names, $scores) {
                            return ['names' => $names, 'scores' => $scores];
                        }, $names, $scores);

                        $counter = 1;
                    @endphp
                    @foreach($combinedData as $data)
                        @if ($counter > 1)
                        <div class="playerResult" id='playerResult2'>
                            <span class="scoreOther" id='scoreResult2'>{{ $data['scores'] }}</span>
                            <span class="nameOther" id='nameResult2'>{{ $data['names'] }}</span>
                        </div> 
                        @endif
                        @php $counter++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>

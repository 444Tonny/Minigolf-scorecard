<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\GameResult;
use App\Models\Sponsor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HoleController extends Controller
{
    public function index(Request $request)
    {
        if(empty(Session::get('playerNames'))) 
        {
            return redirect()->route('home');
        }
        else
        {
            $allSponsors = Sponsor::all()->sortBy('hole_number');
            $numberOfPlayer = Session::get('numberOfPlayer');
            $playerNamesSession = Session::get('playerNames');
            $playerNames = [];
    
            for ($i = 1; $i <= $numberOfPlayer; $i++) {
                $playerNames[] = ucfirst(strtolower($playerNamesSession{$i-1}));
            }     
            return view('hole', compact('playerNames', 'allSponsors'));
        }
    }

    public function saveResults(Request $request)
    {
        try {
            // Récupérez vos données JSON à envoyer dans l'e-mail
            $names = json_decode($request->json('playerNames'), true);
            $scores = json_decode($request->json('totalScores'), true);

            // Fusionner les noms et scores en un seul string
            $mergedData = '';
            for ($i = 0; $i < count($names); $i++) {
                $mergedData .= $names[$i] . ';' . $scores[$i];
                if ($i !== count($names) - 1) {
                    $mergedData .= ',';
                }
            }

            // Save data in database
            $gameResult = new GameResult();
            $gameResult->players = $mergedData;
            $gameResult->save();

            // Répondre avec un message de succès
            return response()->json(['message' => 'Data inserted successfully']);
        } catch (Exception $e) {
            // En cas d'erreur, renvoyez une réponse JSON d'erreur
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500); // Utilisez le code d'erreur HTTP approprié (500 pour une erreur interne du serveur)
        }
    }
}

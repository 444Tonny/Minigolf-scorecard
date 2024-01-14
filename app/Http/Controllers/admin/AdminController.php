<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $gameResult = DB::table('game_results')
        ->select('players', 'game_id', 'game_datetime')
        ->orderBy('game_datetime', 'desc')
        ->paginate(10); // Paginate avec 15 éléments par page

        $players = $gameResult->pluck('players')->all();
        $gameId = $gameResult->pluck('game_id')->all();
        $gameDatetime = $gameResult->pluck('game_datetime')->all();

        $allPlayerPairs = [];

        // Parcourir chaque élément du tableau $playersData
        foreach ($players as $playerString) {
            // Créer un tableau pour stocker les paires (nom, score) pour chaque joueur
            $playerPairs = [];

            // Séparer les joueurs dans la chaîne de joueurs
            $players = explode(",", $playerString);

            // Parcourir chaque joueur et extraire les paires (nom, score)
            foreach ($players as $player) {
                list($playerName, $playerScore) = explode(";", $player);
                $playerPairs[] = [$playerName, $playerScore];
            }

            // Ajouter le tableau des paires (nom, score) au tableau global
            $allPlayerPairs[] = $playerPairs;
        }

        //dd($allPlayerPairs);

        return view('admin.admin', compact('gameResult', 'allPlayerPairs', 'gameId', 'gameDatetime'));
    }

    public function indexSponsors()
    {
        return view('admin.sponsors');
    }


    
}

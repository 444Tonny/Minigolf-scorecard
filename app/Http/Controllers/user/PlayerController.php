<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlayerController extends Controller
{
    public function index()
    {
        $numberOfPlayer = Session::get('numberOfPlayer');
        if(empty($numberOfPlayer))  return redirect()->route('selectNumber');
        else return view('playersSetup', compact('numberOfPlayer'));
    }

    public function namesSelected(Request $request)
    {
        $numberOfPlayer = Session::get('numberOfPlayer');
        $playerNames = [];

        for ($i = 1; $i <= $numberOfPlayer; $i++) {
            $playerNames[] = ucfirst(strtolower(str_replace(array("'", "\"", "`"), "", $request->input("playerName{$i}"))));
        }     

        Session::forget('playerNames');
        Session::put('playerNames', $playerNames);

        return redirect()->route('holes');
    }       
    
    function removeSpecialCharacters($str) {
        // Définir l'expression régulière pour filtrer les caractères spéciaux, guillemets simples et guillemets doubles
        $pattern = '/[^a-zA-Z0-9\s\'"]+/u';
    
        // Remplacer les caractères spéciaux par une chaîne vide
        $filteredStr = preg_replace($pattern, '', $str);
    
        return $filteredStr;
    }
}  

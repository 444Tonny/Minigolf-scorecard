<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NumberController extends Controller
{
    public function index(Request $request)
    {
        Session::forget('numberOfPlayer');
        Session::forget('playerNames');
        return view('numberPlayers');
    }

    public function numberSelected(Request $request)
    {
        if(empty($request->input("number_of_player"))) return redirect()->route('selectNumber');
        else
        {
            $numberOfPlayer = $request->input('number_of_player');

            Session::forget('numberOfPlayer');
            Session::put('numberOfPlayer', $numberOfPlayer);

            return redirect()->route('selectNames');
        }
    }
}

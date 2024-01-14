<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorsController extends Controller
{
    // Affiche le formulaire de mise à jour pour un sponsor spécifique
    public function indexEditor()
    {
        $allSponsors = Sponsor::all()->sortBy('hole_number');
        return view('admin.sponsors', compact('allSponsors'));
    }

    // Traite la mise à jour des données du sponsor
    public function updateSponsors(Request $request)
    {
        $validatedData = $request->validate([
            'text_sponsor' => 'max:255',
            'link_sponsor' => 'max:255',
            'hole_number' => 'required|numeric|min:1|max:18',
        ]);

        $id = $validatedData['hole_number'];

        $sponsorData = [
            'id' => $id,
            'text_sponsor' => addslashes($validatedData['text_sponsor']),
            'link_sponsor' => addslashes($validatedData['link_sponsor']),
            'hole_number' => $validatedData['hole_number']
        ];
        
        Sponsor::updateOrCreate(['id' => $id], $sponsorData);

        return redirect()->route('adminSponsors')->with('success', 'Sponsors updated successfully');
    }
}
<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Validator;

use App\Mail\ImageEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\TemplateEmail;


class MailController extends Controller
{
    public function sendEmailWithJson(Request $request)
    {
        // Récupérez vos données JSON à envoyer dans l'e-mail
        $names = json_decode($request->json('names'), true);
        $scores = json_decode($request->json('scores'), true);
        $mail = $request->json('mail');
        $date = $request->json('date');

        // Check if the email address is valid
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Invalid email address'], 422);
        }

        // Passez les données au modèle d'e-mail et envoyez l'e-mail
        Mail::to($mail)->send(new TemplateEmail($names, $scores, $date));
    
        return response()->json(['message' => 'E-mail sent successfully']);
    }
}
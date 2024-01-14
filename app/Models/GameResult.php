<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    use HasFactory;

    protected $table = 'game_results'; // Remplacez 'nom_de_votre_table' par le nom de votre table dans la base de données

    protected $fillable = ['players', 'game_id', 'game_datetime'];
    public $timestamps = false;
}

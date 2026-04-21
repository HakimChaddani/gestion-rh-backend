<?php

namespace App\Http\Controllers;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    // On garde uniquement les champs que vous utilisez réellement dans vos pages
   protected $fillable = [
    'nom', 'prenom', 'telephone',
    'poste', 'date_embauche', 'salaire', 'statut'
];

public function conges()
{
    return $this->hasMany(Conge::class);
}

public function trajets()
{
    return $this->hasMany(Trajet::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'immatriculation', 'marque', 'modele',
        'capacite_kg', 'statut'
    ];

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
    'nom', 'prenom', 'email', 'telephone',
    'poste', 'date_embauche', 'salaire',
    'statut', 'departement_id'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function conges()
    {
        return $this->hasMany(Conge::class);
    }

    public function trajets()
    {
        return $this->hasMany(Trajet::class);
    }
}

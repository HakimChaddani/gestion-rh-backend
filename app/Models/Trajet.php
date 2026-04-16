<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    protected $fillable = [
        'employe_id', 'vehicule_id', 'date_entree',
        'date_sortie', 'operation', 'nombre_jours', 'prix_unitaire'
    ];

    public function chauffeur()
    {
        return $this->belongsTo(Employe::class, 'employe_id');
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}
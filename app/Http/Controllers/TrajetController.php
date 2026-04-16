<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\Request;

class TrajetController extends Controller
{
    public function index()
    {
        return response()->json(
            Trajet::with(['chauffeur', 'vehicule'])->orderBy('date_entree', 'desc')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'employe_id'   => 'required|exists:employes,id',
            'vehicule_id'  => 'required|exists:vehicules,id',
            'date_entree'  => 'required|date',
            'date_sortie'  => 'nullable|date',
            'operation'    => 'required|string',
            'nombre_jours' => 'required|integer|min:1',
            'prix_unitaire'=> 'required|numeric',
        ]);

        $trajet = Trajet::create($request->all());
        return response()->json($trajet->load(['chauffeur', 'vehicule']), 201);
    }

    public function update(Request $request, $id)
    {
        $trajet = Trajet::findOrFail($id);
        $trajet->update($request->all());
        return response()->json($trajet->load(['chauffeur', 'vehicule']));
    }

    public function destroy($id)
    {
        Trajet::findOrFail($id)->delete();
        return response()->json(['message' => 'Opération supprimée']);
    }
}
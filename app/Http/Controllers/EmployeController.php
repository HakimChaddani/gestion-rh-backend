<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        // On retourne la liste simple sans relation
        return response()->json(Employe::all());
    }

    public function store(Request $request)
    {
        // 1. On valide uniquement ce qu'on reçoit de React
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'required|string|max:255',
            'telephone'      => 'nullable|string',
            'poste'          => 'nullable|string',
            'date_embauche'  => 'nullable|date',
            'salaire'        => 'nullable|numeric',
        ]);

        // 2. On crée l'employé en utilisant UNIQUEMENT les données validées
        // On force le statut à 'actif' si nécessaire
        $employe = Employe::create(array_merge($validated, [
            'statut' => $request->statut ?? 'actif'
        ]));

        return response()->json($employe, 201);
    }

    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);

        $validated = $request->validate([
            'nom'    => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone'      => 'nullable|string',
            'poste'          => 'nullable|string',
            'date_embauche'  => 'nullable|date',
            'salaire'        => 'nullable|numeric',
            'statut'         => 'nullable|string',
        ]);

        $employe->update($validated);
        
        return response()->json($employe);
    }

    public function destroy($id)
    {
        $employe = Employe::findOrFail($id);
        $employe->delete();
        return response()->json(['message' => 'Employé supprimé']);
    }
}
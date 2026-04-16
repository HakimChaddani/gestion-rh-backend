<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        return response()->json(Vehicule::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|unique:vehicules',
            'marque'          => 'required|string',
            'modele'          => 'required|string',
            'capacite_kg'     => 'required|numeric',
        ]);
        $vehicule = Vehicule::create($request->all());
        return response()->json($vehicule, 201);
    }

    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->update($request->all());
        return response()->json($vehicule);
    }

    public function destroy($id)
    {
        Vehicule::findOrFail($id)->delete();
        return response()->json(['message' => 'Véhicule supprimé']);
    }
}
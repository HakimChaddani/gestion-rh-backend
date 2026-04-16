<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        return response()->json(Departement::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $departement = Departement::create($request->all());
        return response()->json($departement, 201);
    }

    public function show($id)
    {
        $departement = Departement::with('employes')->findOrFail($id);
        return response()->json($departement);
    }

    public function update(Request $request, $id)
    {
        $departement = Departement::findOrFail($id);
        $departement->update($request->all());
        return response()->json($departement);
    }

    public function destroy($id)
    {
        Departement::findOrFail($id)->delete();
        return response()->json(['message' => 'Département supprimé']);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index()
    {
        return response()->json(Conge::with('employe')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after_or_equal:date_debut',
            'motif'      => 'required|string',
        ]);

        $conge = Conge::create($request->all());
        return response()->json($conge->load('employe'), 201);
    }

    public function update(Request $request, $id)
    {
        $conge = Conge::findOrFail($id);
        $conge->update($request->only('statut'));
        return response()->json($conge);
    }

    public function destroy($id)
    {
        Conge::findOrFail($id)->delete();
        return response()->json(['message' => 'Congé supprimé']);
    }
}
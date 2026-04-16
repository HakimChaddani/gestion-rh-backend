<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        return response()->json(Employe::with('departement')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'            => 'required|string',
            'prenom'         => 'required|string',
            'email'          => 'required|email|unique:employes',
            'poste'          => 'required|string',
            'date_embauche'  => 'required|date',
            'salaire'        => 'required|numeric',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $employe = Employe::create($request->all());
        return response()->json($employe->load('departement'), 201);
    }

    public function show($id)
    {
        $employe = Employe::with(['departement', 'conges'])->findOrFail($id);
        return response()->json($employe);
    }

    public function update(Request $request, $id)
    {
        $employe = Employe::findOrFail($id);
        $employe->update($request->all());
        return response()->json($employe->load('departement'));
    }

    public function destroy($id)
    {
        Employe::findOrFail($id)->delete();
        return response()->json(['message' => 'Employé supprimé']);
    }
}
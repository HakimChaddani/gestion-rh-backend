<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
{
    return response()->json(Employe::all());
}

public function store(Request $request)
{
    $request->validate([
        'nom'    => 'required|string',
        'prenom' => 'required|string',
    ]);
    $employe = Employe::create($request->all());
    return response()->json($employe, 201);
}

public function update(Request $request, $id)
{
    $employe = Employe::findOrFail($id);
    $employe->update($request->all());
    return response()->json($employe);
}

public function destroy($id)
{
    Employe::findOrFail($id)->delete();
    return response()->json(['message' => 'Employé supprimé']);
}
}
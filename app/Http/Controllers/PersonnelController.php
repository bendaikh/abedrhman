<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index()
    {
        $personnel = Personnel::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.personnel.index', [
            'page_title' => 'Personnel',
            'personnel' => $personnel
        ]);
    }

    public function create()
    {
        return view('tiers.personnel.form', [
            'page_title' => 'Créer un personnel',
            'personnel' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'poste' => 'nullable|string|max:255',
            'tache' => 'nullable|string|max:255',
        ]);

        Personnel::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'personnel'])->with('success', 'Personnel créé avec succès.');
    }

    public function show(string $id)
    {
        $personnel = Personnel::findOrFail($id);
        return view('tiers.personnel.show', [
            'page_title' => 'Détails du personnel',
            'personnel' => $personnel
        ]);
    }

    public function edit(string $id)
    {
        $personnel = Personnel::findOrFail($id);
        return view('tiers.personnel.form', [
            'page_title' => 'Modifier le personnel',
            'personnel' => $personnel
        ]);
    }

    public function update(Request $request, string $id)
    {
        $personnel = Personnel::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'cin' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'poste' => 'nullable|string|max:255',
            'tache' => 'nullable|string|max:255',
        ]);

        $personnel->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'personnel'])->with('success', 'Personnel modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->delete();

        return redirect()->route('tiers.index', ['tab' => 'personnel'])->with('success', 'Personnel supprimé avec succès.');
    }
}







<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.partenaires.index', [
            'page_title' => 'Partenaires',
            'partenaires' => $partenaires
        ]);
    }

    public function create()
    {
        return view('tiers.partenaires.form', [
            'page_title' => 'Créer un partenaire',
            'partenaire' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        Partenaire::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'partenaires'])->with('success', 'Partenaire créé avec succès.');
    }

    public function show(string $id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('tiers.partenaires.show', [
            'page_title' => 'Détails du partenaire',
            'partenaire' => $partenaire
        ]);
    }

    public function edit(string $id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('tiers.partenaires.form', [
            'page_title' => 'Modifier le partenaire',
            'partenaire' => $partenaire
        ]);
    }

    public function update(Request $request, string $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'activite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        $partenaire->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'partenaires'])->with('success', 'Partenaire modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->delete();

        return redirect()->route('tiers.index', ['tab' => 'partenaires'])->with('success', 'Partenaire supprimé avec succès.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Prestataire;
use Illuminate\Http\Request;

class PrestataireController extends Controller
{
    public function index()
    {
        $prestataires = Prestataire::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.prestataires.index', [
            'page_title' => 'Prestataires',
            'prestataires' => $prestataires
        ]);
    }

    public function create()
    {
        return view('tiers.prestataires.form', [
            'page_title' => 'Créer un prestataire',
            'prestataire' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Prestataire::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'prestataires'])->with('success', 'Prestataire créé avec succès.');
    }

    public function show(string $id)
    {
        $prestataire = Prestataire::findOrFail($id);
        return view('tiers.prestataires.show', [
            'page_title' => 'Détails du prestataire',
            'prestataire' => $prestataire
        ]);
    }

    public function edit(string $id)
    {
        $prestataire = Prestataire::findOrFail($id);
        return view('tiers.prestataires.form', [
            'page_title' => 'Modifier le prestataire',
            'prestataire' => $prestataire
        ]);
    }

    public function update(Request $request, string $id)
    {
        $prestataire = Prestataire::findOrFail($id);

        $validated = $request->validate([
            'raison_sociale' => 'nullable|string|max:255',
            'responsable_nom' => 'nullable|string|max:255',
            'responsable_prenom' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'ice' => 'nullable|string|max:255',
            'rib' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $prestataire->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'prestataires'])->with('success', 'Prestataire modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $prestataire = Prestataire::findOrFail($id);
        $prestataire->delete();

        return redirect()->route('tiers.index', ['tab' => 'prestataires'])->with('success', 'Prestataire supprimé avec succès.');
    }
}


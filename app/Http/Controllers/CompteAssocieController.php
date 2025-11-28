<?php

namespace App\Http\Controllers;

use App\Models\CompteAssocie;
use Illuminate\Http\Request;

class CompteAssocieController extends Controller
{
    public function index()
    {
        $comptesAssocies = CompteAssocie::orderBy('created_at', 'desc')->paginate(15);
        return view('tiers.comptes-associes.index', [
            'page_title' => 'Comptes Associés',
            'comptesAssocies' => $comptesAssocies
        ]);
    }

    public function create()
    {
        return view('tiers.comptes-associes.form', [
            'page_title' => 'Créer un compte associé',
            'compteAssocie' => null
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        CompteAssocie::create($validated);

        return redirect()->route('tiers.index', ['tab' => 'comptes-associes'])->with('success', 'Compte associé créé avec succès.');
    }

    public function show(string $id)
    {
        $compteAssocie = CompteAssocie::findOrFail($id);
        return view('tiers.comptes-associes.show', [
            'page_title' => 'Détails du compte associé',
            'compteAssocie' => $compteAssocie
        ]);
    }

    public function edit(string $id)
    {
        $compteAssocie = CompteAssocie::findOrFail($id);
        return view('tiers.comptes-associes.form', [
            'page_title' => 'Modifier le compte associé',
            'compteAssocie' => $compteAssocie
        ]);
    }

    public function update(Request $request, string $id)
    {
        $compteAssocie = CompteAssocie::findOrFail($id);

        $validated = $request->validate([
            'nom_prenom' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'rib' => 'nullable|string|max:255',
        ]);

        $compteAssocie->update($validated);

        return redirect()->route('tiers.index', ['tab' => 'comptes-associes'])->with('success', 'Compte associé modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $compteAssocie = CompteAssocie::findOrFail($id);
        $compteAssocie->delete();

        return redirect()->route('tiers.index', ['tab' => 'comptes-associes'])->with('success', 'Compte associé supprimé avec succès.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\TypeCharge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Display a listing of the charges.
     */
    public function index()
    {
        $charges = Charge::with('typeCharge.rubrique')->latest('date_charge')->get();
        $typesCharge = TypeCharge::with('rubrique')->active()->ordered()->get();

        return view('sections.charges', [
            'page_title' => 'Les charges',
            'charges' => $charges,
            'typesCharge' => $typesCharge,
        ]);
    }

    /**
     * Store a newly created charge in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_charge_id' => 'required|exists:type_charges,id',
            'designation' => 'nullable|string|max:255',
            'montant' => 'required|numeric|min:0.01',
            'numero_recu_paiement' => 'nullable|string|max:255',
            'observation' => 'nullable|string|max:1000',
            'date_charge' => 'required|date',
        ]);

        Charge::create($validated);

        return redirect()->route('charges.index')
            ->with('success', 'Charge enregistrée avec succès.');
    }

    /**
     * Update the specified charge in storage.
     */
    public function update(Request $request, Charge $charge)
    {
        $validated = $request->validate([
            'type_charge_id' => 'required|exists:type_charges,id',
            'designation' => 'nullable|string|max:255',
            'montant' => 'required|numeric|min:0.01',
            'numero_recu_paiement' => 'nullable|string|max:255',
            'observation' => 'nullable|string|max:1000',
            'date_charge' => 'required|date',
        ]);

        $charge->update($validated);

        return redirect()->route('charges.index')
            ->with('success', 'Charge mise à jour avec succès.');
    }

    /**
     * Remove the specified charge from storage.
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();

        return redirect()->route('charges.index')
            ->with('success', 'Charge supprimée avec succès.');
    }
}

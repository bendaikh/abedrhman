<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Service;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of factures.
     */
    public function index(Request $request)
    {
        $query = Facture::with(['service.typeService', 'client']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('nom_raison_sociale', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_facture', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_facture', '<=', $request->date_to);
        }

        $factures = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        // Statistics
        $totalFactures = Facture::count();
        $totalMontant = Facture::sum('montant_total');
        $totalPaye = Facture::sum('montant_paye');
        $facturesPayees = Facture::where('statut', 'payee')->count();

        return view('sections.factures', [
            'page_title' => 'Factures',
            'factures' => $factures,
            'totalFactures' => $totalFactures,
            'totalMontant' => $totalMontant,
            'totalPaye' => $totalPaye,
            'facturesPayees' => $facturesPayees,
        ]);
    }

    /**
     * Create a facture from a service (convert receipt to invoice)
     */
    public function createFromService(Service $service)
    {
        // Check if facture already exists for this service
        $existingFacture = Facture::where('service_id', $service->id)->first();
        
        if ($existingFacture) {
            return redirect()->route('factures.show', $existingFacture)
                ->with('info', 'Une facture existe déjà pour ce service.');
        }

        // Load service with relationships
        $service->load(['client', 'typeService', 'payments', 'sousServices']);

        // Determine status based on payments
        $statut = 'envoyee';
        if ($service->montant_total <= 0) {
            $statut = 'payee';
        } elseif ($service->total_payments >= $service->montant_total) {
            $statut = 'payee';
        } elseif ($service->total_payments > 0) {
            $statut = 'partielle';
        }

        // Create the facture
        $facture = Facture::create([
            'numero' => Facture::generateNumero(),
            'service_id' => $service->id,
            'client_id' => $service->client_id,
            'montant_total' => $service->montant_total,
            'montant_paye' => $service->total_payments,
            'date_facture' => now(),
            'date_echeance' => now()->addDays(30),
            'statut' => $statut,
        ]);

        return redirect()->route('factures.show', $facture)
            ->with('success', 'Facture créée avec succès.');
    }

    /**
     * Display the specified facture.
     */
    public function show(Facture $facture)
    {
        $facture->load(['service.typeService', 'service.payments', 'service.sousServices', 'client.dirigeants']);

        return view('sections.factures-show', [
            'page_title' => 'Facture ' . $facture->numero,
            'facture' => $facture,
        ]);
    }

    /**
     * Update facture status
     */
    public function updateStatut(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'statut' => 'required|in:brouillon,envoyee,payee,partielle,annulee',
        ]);

        $facture->update($validated);

        return redirect()->back()
            ->with('success', 'Statut de la facture mis à jour.');
    }

    /**
     * Delete a facture
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();

        return redirect()->route('factures.index')
            ->with('success', 'Facture supprimée avec succès.');
    }

    /**
     * Print/view facture as PDF-ready page
     */
    public function print(Facture $facture)
    {
        $facture->load(['service.typeService', 'service.payments', 'client.dirigeants']);

        return view('sections.factures-print', [
            'facture' => $facture,
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
use App\Models\TypeService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $services = Service::with(['typeService', 'client', 'payments'])->latest()->get();
        $typesServices = TypeService::active()->ordered()->get();

        return view('sections.services', [
            'page_title' => 'Services',
            'services' => $services,
            'typesServices' => $typesServices,
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $typesServices = TypeService::active()->ordered()->get();
        $clients = Client::orderBy('nom_raison_sociale')->orderBy('nom')->get();

        return view('sections.services-create', [
            'page_title' => 'Nouveau service',
            'typesServices' => $typesServices,
            'clients' => $clients,
        ]);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['status'] = 'initialiser'; // Set initial status

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service créé avec succès.');
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service)
    {
        return view('sections.services-show', [
            'page_title' => 'Détails du service',
            'service' => $service->load(['typeService', 'client', 'payments']),
        ]);
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $typesServices = TypeService::active()->ordered()->get();
        $clients = Client::orderBy('nom_raison_sociale')->orderBy('nom')->get();

        return view('sections.services-edit', [
            'page_title' => 'Modifier le service',
            'service' => $service->load(['client', 'payments']),
            'typesServices' => $typesServices,
            'clients' => $clients,
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'status' => 'required|in:initialiser,en_cours,termine,annule',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service mis à jour avec succès.');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service supprimé avec succès.');
    }

    /**
     * Show payment management for a service
     */
    public function payments(Service $service)
    {
        return view('sections.services-payments', [
            'page_title' => 'Gestion des paiements',
            'service' => $service->load(['typeService', 'client', 'payments']),
        ]);
    }

    /**
     * Store a new payment for a service
     */
    public function storePayment(Request $request, Service $service)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0.01',
            'type' => 'required|in:avance,paiement,solde',
            'mode_paiement' => 'required|in:especes,cheque,virement,carte',
            'reference' => 'nullable|string|max:255',
            'date_paiement' => 'required|date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $service->payments()->create($validated);

        return redirect()->route('services.payments', $service)
            ->with('success', 'Paiement enregistré avec succès.');
    }

    /**
     * Delete a payment
     */
    public function destroyPayment(Service $service, Payment $payment)
    {
        if ($payment->service_id !== $service->id) {
            abort(404);
        }

        $payment->delete();

        return redirect()->route('services.payments', $service)
            ->with('success', 'Paiement supprimé avec succès.');
    }

    /**
     * Get client details for AJAX request
     */
    public function getClientDetails(Client $client)
    {
        return response()->json([
            'id' => $client->id,
            'nom' => $client->type === 'morale' 
                ? $client->nom_raison_sociale 
                : ($client->nom . ' ' . $client->prenom),
            'gerant' => $client->type === 'morale' 
                ? ($client->dirigeants->first()->nom ?? 'N/A') 
                : 'N/A',
            'ville' => $client->ville ?? 'N/A',
            'type' => $client->type,
        ]);
    }

    /**
     * Display invoice for a service
     */
    public function invoice(Service $service)
    {
        return view('sections.services-invoice', [
            'service' => $service->load(['typeService', 'client.dirigeants', 'payments']),
        ]);
    }

    /**
     * Display all payments across all services
     */
    public function allPayments(Request $request)
    {
        $query = Payment::with(['service.typeService', 'service.client']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('service.client', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('nom_raison_sociale', 'like', "%{$search}%");
            })->orWhere('reference', 'like', "%{$search}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('mode')) {
            $query->where('mode_paiement', $request->mode);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date_paiement', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date_paiement', '<=', $request->date_to);
        }

        $payments = $query->orderBy('date_paiement', 'desc')->paginate(20)->withQueryString();

        // Calculate statistics
        $totalAmount = Payment::sum('montant');
        $todayAmount = Payment::whereDate('date_paiement', today())->sum('montant');
        $monthAmount = Payment::whereMonth('date_paiement', now()->month)
            ->whereYear('date_paiement', now()->year)
            ->sum('montant');

        return view('sections.payments', [
            'page_title' => 'Gestion des Paiements',
            'payments' => $payments,
            'totalAmount' => $totalAmount,
            'todayAmount' => $todayAmount,
            'monthAmount' => $monthAmount,
        ]);
    }
}



<?php

namespace App\Http\Controllers;

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
        $services = Service::with('typeService')->latest()->get();
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

        return view('sections.services-create', [
            'page_title' => 'Nouveau service',
            'typesServices' => $typesServices,
        ]);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'duree' => 'nullable|integer|min:1',
            'unite_duree' => 'required|in:heure,jour,semaine,mois,annee',
        ]);

        $validated['is_active'] = $request->has('is_active');

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
            'page_title' => $service->nom,
            'service' => $service->load('typeService'),
        ]);
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        $typesServices = TypeService::active()->ordered()->get();

        return view('sections.services-edit', [
            'page_title' => 'Modifier le service',
            'service' => $service,
            'typesServices' => $typesServices,
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_service_id' => 'required|exists:types_services,id',
            'description' => 'nullable|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'duree' => 'nullable|integer|min:1',
            'unite_duree' => 'required|in:heure,jour,semaine,mois,annee',
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
}


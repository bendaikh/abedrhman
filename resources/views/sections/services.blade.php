@extends('layouts.app')

@section('title', 'Services - Abedrhman')

@section('content')
@php
    $services = ['Création domiciliation', 'Étude', 'Formation', 'Événement', 'Location bureau', 'Location', 'Salle'];
@endphp
<div class="space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Services</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Catalogue d'offres activables individuellement ou en pack</p>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach ($services as $service)
                <span class="px-4 py-2 rounded-full text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-200">
                    {{ $service }}
                </span>
            @endforeach
        </div>
    </div>
</div>
@endsection


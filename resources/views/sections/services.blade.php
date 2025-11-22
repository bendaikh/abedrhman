@extends('layouts.app')

@section('title', 'Services - Abedrhman')

@section('content')
@php
    $services = ['Création domiciliation', 'Étude', 'Formation', 'Événement', 'Location bureau', 'Location', 'Salle'];
@endphp
<div class="space-y-6 sm:space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4 mb-4">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">Services</h2>
            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Catalogue d'offres activables individuellement ou en pack</p>
        </div>
        <div class="flex flex-wrap gap-2 sm:gap-3">
            @foreach ($services as $service)
                <span class="px-3 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-200">
                    {{ $service }}
                </span>
            @endforeach
        </div>
    </div>
</div>
@endsection


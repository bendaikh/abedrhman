@extends('layouts.app')

@section('title', 'Base tiers - Abedrhman')

@section('content')
@php
    $tiers = ['Fournisseurs', 'Partenaires', 'Personnel', 'Comptable bailleur', 'Administration'];
@endphp
<div class="space-y-6 sm:space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow p-4 sm:p-6 border border-gray-100 dark:border-gray-700">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-3 sm:mb-4">Base tiers</h2>
        <ul class="space-y-2 text-xs sm:text-sm text-gray-700 dark:text-gray-300">
            @foreach ($tiers as $tier)
                <li class="flex items-center">
                    <span class="h-2 w-2 rounded-full bg-blue-500 mr-2 sm:mr-3 flex-shrink-0"></span>
                    {{ $tier }}
                </li>
            @endforeach
        </ul>
        <p class="mt-3 sm:mt-4 text-xs text-gray-500 dark:text-gray-400">
            Fournisseurs, partenaires, personnel, comptable bailleur et administrations sont suivis au même endroit.
        </p>
    </div>
</div>
@endsection


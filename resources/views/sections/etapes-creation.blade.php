@extends('layouts.app')

@section('title', 'Étapes création - Abedrhman')

@section('content')
@php
    $creationSteps = [
        'Qualification du besoin',
        'Étude & cadrage',
        'Conception et contractualisation',
        'Déploiement et accompagnement'
    ];
@endphp
<div class="space-y-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Étapes service création</h3>
        <ol class="space-y-4">
            @foreach ($creationSteps as $index => $step)
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-8 w-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold mr-4">
                        {{ $index + 1 }}
                    </span>
                    <p class="text-sm text-gray-700 dark:text-gray-200">{{ $step }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center mb-6">
            <a href="{{ route('dashboard.employe') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Mon solde de congé</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">Congés annuels</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $solde->solde_annuel }} jours</p>
                </div>

                <div class="bg-purple-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-purple-800 mb-2">Congés exceptionnels</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $solde->solde_exceptionnel }} jours</p>
                </div>

                <div class="bg-green-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-800 mb-2">Congés maladie</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $solde->solde_maladie }} jours</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Total des congés disponibles</h3>
                <p class="text-4xl font-bold text-gray-900">{{ $solde->solde_total }} jours</p>
            </div>

            @if($solde->commentaire)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Commentaire</h3>
                    <p class="text-gray-600">{{ $solde->commentaire }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 
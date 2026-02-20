@extends('layouts.app')

@section('title', 'Mis Premios')

@section('content')
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Mi <span class="text-gaming-600">Inventario</span></h1>
        <p class="text-gray-400">Objetos canjeados y fecha de adquisición</p>
    </div>

    @if($rewards->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aún no has canjeado ninguna recompensa.</p>
            <a href="{{ route('rewards.catalog') }}" class="mt-4 inline-block bg-gaming-600 text-white px-6 py-2 rounded-full hover:bg-gaming-700 transition">Ir al Catálogo</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($rewards as $reward)
            <div class="bg-gaming-800 rounded-xl overflow-hidden shadow-lg border border-gaming-700 hover:border-gaming-600 transition-all duration-300">
                <div class="relative h-48 bg-gaming-900 flex items-center justify-center">
                    @if($reward->image_path)
                        <img src="{{ $reward->image_path }}" alt="{{ $reward->name }}" class="w-full h-full object-cover opacity-75">
                    @else
                        <span class="text-6xl text-gray-500">📦</span>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <span class="text-xs text-green-400 font-bold uppercase tracking-wider">Adquirido</span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-white mb-1">{{ $reward->name }}</h3>
                    <p class="text-xs text-gray-400 mb-4">
                        Canjeado el: {{ $reward->pivot->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="text-gray-400 text-sm line-clamp-2">{{ $reward->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection

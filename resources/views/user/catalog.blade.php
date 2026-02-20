@extends('layouts.app')

@section('title', 'Catálogo de Recompensas')

@section('content')
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-2">Catálogo de <span class="text-gaming-600">Recompensas</span></h1>
        <p class="text-gray-400">Canjea tus puntos por contenido exclusivo</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($rewards as $reward)
        <div class="bg-gaming-800 rounded-xl overflow-hidden shadow-lg border border-gaming-700 hover:border-gaming-600 transition-all duration-300 transform hover:-translate-y-1">
            <div class="relative h-48 bg-gaming-900 flex items-center justify-center">
                @if($reward->image_path)
                    <img src="{{ $reward->image_path }}" alt="{{ $reward->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-6xl">🎁</span>
                @endif
                <div class="absolute top-0 right-0 m-2 bg-gaming-600 text-white text-xs font-bold px-2 py-1 rounded">
                    {{ number_format($reward->point_cost) }} PTS
                </div>
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2">{{ $reward->name }}</h3>
                <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $reward->description }}</p>
                
                <form action="{{ route('rewards.redeem', $reward) }}" method="POST">
                    @csrf
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-gaming-600 to-purple-600 hover:from-gaming-700 hover:to-purple-700 text-white font-bold py-2 px-4 rounded transition-all duration-200 shadow-md transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                        @if(auth()->user()->points < $reward->point_cost) disabled @endif>
                        @if(auth()->user()->points >= $reward->point_cost)
                            Canjear Ahora
                        @else
                            Puntos Insuficientes
                        @endif
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection

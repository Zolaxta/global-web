@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gaming-600">Gestión de Usuarios</h1>
        <span class="text-gray-400">Panel de Control</span>
    </div>

    <div class="bg-gaming-800 shadow-md rounded-lg overflow-hidden border border-gaming-700">
        <table class="min-w-full divide-y divide-gaming-700">
            <thead class="bg-gaming-900">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Puntos</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Bonificar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gaming-700">
                @foreach ($users as $user)
                <tr class="hover:bg-gaming-700 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-white">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-400">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gaming-600 text-white">
                            {{ number_format($user->points) }} PTS
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('admin.add_points', $user) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="number" name="points" min="1" placeholder="Cant." required class="w-20 px-2 py-1 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded transition">Sumar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
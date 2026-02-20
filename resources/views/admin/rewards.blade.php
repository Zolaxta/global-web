@extends('layouts.app')

@section('title', 'Gestión de Premios')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gaming-600">Gestión de Recompensas</h1>
            <span class="text-gray-400">Admin Panel</span>
        </div>
        <button onclick="toggleModal('createRewardModal')" class="bg-gaming-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition shadow-lg">
            + Nuevo Premio
        </button>
    </div>

    <div class="bg-gaming-800 shadow-md rounded-lg overflow-hidden border border-gaming-700">
        <table class="min-w-full divide-y divide-gaming-700">
            <thead class="bg-gaming-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Premio</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Costo</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gaming-700">
                @forelse ($rewards as $reward)
                <tr class="hover:bg-gaming-700 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($reward->image_path)
                                <img class="h-10 w-10 rounded object-cover mr-4" src="{{ $reward->image_path }}" alt="{{ $reward->name }}">
                            @endif
                            <div>
                                <div class="text-sm font-medium text-white">{{ $reward->name }}</div>
                                <div class="text-xs text-gray-400 truncate max-w-xs">{{ $reward->description }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gaming-600 text-white">
                            {{ number_format($reward->point_cost) }} PTS
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button onclick="toggleModal('editRewardModal-{{ $reward->id }}')" class="text-blue-400 hover:text-blue-300 font-bold mr-3 transition">Editar</button>
                        <button onclick="toggleModal('deleteRewardModal-{{ $reward->id }}')" class="text-red-500 hover:text-red-400 font-bold transition">Eliminar</button>
                    </td>
                </tr>

                <div id="editRewardModal-{{ $reward->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-70 flex items-center justify-center">
                    <div class="bg-gaming-800 rounded-lg p-6 w-full max-w-md border border-gaming-700 shadow-2xl">
                        <h2 class="text-xl font-bold text-white mb-4">Editar Premio: {{ $reward->name }}</h2>
                        <form action="{{ route('admin.rewards.update', $reward) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                                <input type="text" name="name" value="{{ $reward->name }}" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Descripción</label>
                                <textarea name="description" rows="3" class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">{{ $reward->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Costo (Puntos)</label>
                                <input type="number" name="point_cost" value="{{ $reward->point_cost }}" min="1" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-300 mb-1">URL Imagen (Opcional)</label>
                                <input type="text" name="image_path" value="{{ $reward->image_path }}" class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                            </div>
                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="toggleModal('editRewardModal-{{ $reward->id }}')" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancelar</button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="deleteRewardModal-{{ $reward->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-70 flex items-center justify-center">
                    <div class="bg-gaming-800 rounded-lg p-6 w-full max-w-sm border border-gaming-700 shadow-2xl text-center">
                        <h2 class="text-xl font-bold text-red-500 mb-4">¿Eliminar Premio?</h2>
                        <p class="text-gray-300 mb-6">Esta acción no se puede deshacer. Los usuarios que ya lo canjearon lo conservarán en su inventario.</p>
                        <form action="{{ route('admin.rewards.destroy', $reward) }}" method="POST" class="flex justify-center gap-4">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="toggleModal('deleteRewardModal-{{ $reward->id }}')" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancelar</button>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">Sí, Eliminar</button>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">No hay recompensas creadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="createRewardModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-70 flex items-center justify-center">
        <div class="bg-gaming-800 rounded-lg p-6 w-full max-w-md border border-gaming-700 shadow-2xl">
            <h2 class="text-xl font-bold text-white mb-4">Nuevo Premio</h2>
            <form action="{{ route('admin.rewards.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Costo (Puntos)</label>
                    <input type="number" name="point_cost" min="1" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">URL Imagen (Opcional)</label>
                    <input type="text" name="image_path" placeholder="https://..." class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="toggleModal('createRewardModal')" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancelar</button>
                    <button type="submit" class="bg-gaming-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">Crear Premio</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle('hidden');
        }
    </script>
@endsection
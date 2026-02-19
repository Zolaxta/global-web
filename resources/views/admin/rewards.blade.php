<x-app-layout>
    <x-slot:title>Gestión de Premios</x-slot>

    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gaming-600">Gestión de Recompensas</h1>
        <span class="text-gray-400">Admin Panel</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulario de Creación -->
        <div class="lg:col-span-1">
            <div class="bg-gaming-800 p-6 rounded-lg shadow-md border border-gaming-700">
                <h2 class="text-xl font-bold text-white mb-4">Nuevo Premio</h2>
                <form action="{{ route('admin.rewards.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                        <input type="text" name="name" id="name" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Descripción</label>
                        <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="point_cost" class="block text-sm font-medium text-gray-300 mb-1">Costo (Puntos)</label>
                        <input type="number" name="point_cost" id="point_cost" min="1" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                    </div>

                    <div class="mb-6">
                        <label for="image_path" class="block text-sm font-medium text-gray-300 mb-1">URL Imagen (Opcional)</label>
                        <input type="text" name="image_path" id="image_path" placeholder="https://..." class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                    </div>

                    <button type="submit" class="w-full bg-gaming-600 hover:bg-gaming-700 text-white font-bold py-2 px-4 rounded transition">
                        Crear Premio
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista de Premios -->
        <div class="lg:col-span-2">
            <div class="bg-gaming-800 shadow-md rounded-lg overflow-hidden border border-gaming-700">
                <table class="min-w-full divide-y divide-gaming-700">
                    <thead class="bg-gaming-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Costo</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gaming-700">
                        @foreach ($rewards as $reward)
                        <tr class="hover:bg-gaming-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-white">{{ $reward->name }}</div>
                                <div class="text-xs text-gray-400 truncate max-w-xs">{{ $reward->description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gaming-600 text-white">
                                    {{ $reward->point_cost }} PTS
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.rewards.destroy', $reward) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este premio?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($rewards->isEmpty())
                    <div class="p-6 text-center text-gray-500">No hay recompensas creadas aún.</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gaming-600">Gestión de Usuarios</h1>
            <span class="text-gray-400">Panel de Control</span>
        </div>
        <button onclick="document.getElementById('createUserModal').classList.remove('hidden')" class="bg-gaming-600 hover:bg-gaming-700 text-white font-bold py-2 px-4 rounded transition">
            Crear Nuevo Usuario
        </button>
    </div>

    <div class="bg-gaming-800 shadow-md rounded-lg overflow-hidden border border-gaming-700">
        <table class="min-w-full divide-y divide-gaming-700">
            <thead class="bg-gaming-900">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Puntos</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Bonificar</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Acciones</th>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button 
                            data-id="{{ $user->id }}" 
                            data-name="{{ $user->name }}" 
                            data-email="{{ $user->email }}" 
                            data-points="{{ $user->points }}"
                            onclick="openEditModal(this.dataset.id, this.dataset.name, this.dataset.email, this.dataset.points)" 
                            class="text-indigo-400 hover:text-indigo-600 mr-3 transition">
                            Editar
                        </button>
                        
                        <button 
                            data-id="{{ $user->id }}" 
                            data-name="{{ $user->name }}"
                            onclick="openDeleteModal(this.dataset.id, this.dataset.name)" 
                            class="text-red-400 hover:text-red-600 transition">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create User Modal -->
    <div id="createUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gaming-800 rounded-lg shadow-xl border border-gaming-700 w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-white">Crear Nuevo Usuario</h3>
                <button onclick="document.getElementById('createUserModal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Contraseña</label>
                    <input type="password" name="password" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Puntos Iniciales</label>
                    <input type="number" name="points" value="0" min="0" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('createUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-gaming-600 text-white rounded hover:bg-gaming-700 transition">Crear</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gaming-800 rounded-lg shadow-xl border border-gaming-700 w-full max-w-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-white">Editar Usuario</h3>
                <button onclick="document.getElementById('editUserModal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Nombre</label>
                    <input type="text" name="name" id="editName" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" id="editEmail" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Puntos (Sobreescribir)</label>
                    <input type="number" name="points" id="editPoints" min="0" required class="w-full px-3 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('editUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-gaming-600 text-white rounded hover:bg-gaming-700 transition">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gaming-800 rounded-lg shadow-xl border border-gaming-700 w-full max-w-sm p-6 text-center">
            <h3 class="text-xl font-bold text-white mb-2">¿Eliminar Usuario?</h3>
            <p class="text-gray-400 mb-6">Estás a punto de eliminar a <span id="deleteUserName" class="text-gaming-600 font-bold"></span>. Esta acción no se puede deshacer.</p>
            
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="document.getElementById('deleteUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Eliminar Definitivamente</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, points) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPoints').value = points;
            document.getElementById('editUserForm').action = `/admin/users/${id}`;
            document.getElementById('editUserModal').classList.remove('hidden');
        }

        function openDeleteModal(id, name) {
            document.getElementById('deleteUserName').textContent = name;
            document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
            document.getElementById('deleteUserModal').classList.remove('hidden');
        }
    </script>
@endsection
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.dashboard', compact('users'));
    }

    public function addPoints(Request $request, User $user)
    {
        $request->validate([
            'points' => 'required|integer|min:1',
        ]);

        $user->points += $request->points;
        $user->save();

        return back()->with('success', "Se han añadido {$request->points} puntos a {$user->name}.");
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'points' => 'required|integer|min:0',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'player';

        User::create($validated);

        return back()->with('success', 'Usuario creado exitosamente.');
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'points' => 'required|integer|min:0',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->points = $validated['points'];
        $user->save();

        return back()->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Usuario eliminado exitosamente.');
    }

    public function rewardsIndex()
    {
        $rewards = Reward::all();
        return view('admin.rewards', compact('rewards'));
    }

    public function storeReward(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'point_cost' => 'required|integer|min:1',
            'image_path' => 'nullable|string',
        ]);

        Reward::create($validated);

        return back()->with('success', 'Recompensa creada exitosamente.');
    }

    public function destroyReward(Reward $reward)
    {
        $reward->delete();
        return back()->with('success', 'Recompensa eliminada exitosamente.');
    }
    public function updateReward(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'point_cost' => 'required|integer|min:1',
            'image_path' => 'nullable|string',
        ]);

        $reward->update($validated);

        return back()->with('success', 'Recompensa actualizada exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reward;
use Illuminate\Http\Request;

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
            'image_path' => 'nullable|string', // Aceptamos URL simple por simplicidad
        ]);

        Reward::create($validated);

        return back()->with('success', 'Recompensa creada exitosamente.');
    }

    public function destroyReward(Reward $reward)
    {
        $reward->delete();
        return back()->with('success', 'Recompensa eliminada exitosamente.');
    }
}

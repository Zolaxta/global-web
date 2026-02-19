<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = Reward::where('is_active', true)->get();
        return view('user.catalog', compact('rewards'));
    }

    public function inventory()
    {
        $rewards = Auth::user()->rewards()->orderByPivot('created_at', 'desc')->get();
        return view('user.inventory', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reward $reward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reward $reward)
    {
        //
    }

    /**
     * Redeem a reward.
     */
    public function redeem(Reward $reward)
    {
        $user = Auth::user();

        if ($user->points < $reward->point_cost) {
            return back()->with('error', 'No tienes suficientes puntos para canjear esta recompensa.');
        }

        // Deduct points
        $user->points -= $reward->point_cost;
        $user->save();

        // Record transaction
        $user->rewards()->attach($reward->id, ['paid_amount' => $reward->point_cost]);

        // Return SSR notification view
        return view('rewards.notification', ['reward' => $reward]);
    }
}

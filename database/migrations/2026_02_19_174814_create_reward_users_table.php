<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reward_user', function (Blueprint $table) {
            $table->id();   
            // Llaves foráneas para PostgreSQL
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('reward_id')->constrained()->onDelete('cascade'); 
            // Registro histórico del costo al momento del canje
            $table->integer('paid_amount');
    
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('reward_user');
    }
};

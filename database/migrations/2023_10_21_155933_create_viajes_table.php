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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('taxista_id')->nullable();
            $table->string('from')->nullable();
            $table->string('from_coords')->nullable();
            $table->string('to')->nullable();
            $table->string('to_coords')->nullable();
            $table->string('indications')->nullable();
            $table->string('passengers')->nullable();
            $table->string('price')->nullable();
            $table->string('estado')->nullable();
            $table->date('fecha')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('taxista_id')->references('id')->on('taxistas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};

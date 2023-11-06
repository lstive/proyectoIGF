<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('rol')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insertar usuarios
        DB::table('users')->insert([
            [
                'name' => 'administrador1',
                'email' => 'administrador1@servitaxi.com',
                'rol' => 'admin',
                'password' => Hash::make('ServiTaxi1*'),
            ],
            [
                'name' => 'administrador2',
                'email' => 'administrador2@servitaxi.com',
                'rol' => 'admin',
                'password' => Hash::make('ServiTaxi2*'),
            ],
            [
                'name' => 'administrador3',
                'email' => 'administrador3@servitaxi.com',
                'rol' => 'admin',
                'password' => Hash::make('ServiTaxi3*'),
            ],
            [
                'name' => 'administrador4',
                'email' => 'administrador4@servitaxi.com',
                'rol' => 'admin',
                'password' => Hash::make('ServiTaxi4*'),
            ],
            [
                'name' => 'administrador5',
                'email' => 'administrador5@servitaxi.com',
                'rol' => 'admin',
                'password' => Hash::make('ServiTaxi5*'),
            ],
            [
                'name' => 'Carlos Pérez',
                'email' => 'carlos.perez@servitaxi.com',
                'rol' => 'operator',
                'password' => Hash::make('Operador1*'),
            ],
            [
                'name' => 'Ana Ramírez',
                'email' => 'ana.ramirez@servitaxi.com',
                'rol' => 'operator',
                'password' => Hash::make('Operador2*'),
            ],
            [
                'name' => 'José Martínez',
                'email' => 'jose.martinez@servitaxi.com',
                'rol' => 'operator',
                'password' => Hash::make('Operador3*'),
            ],
            [
                'name' => 'María García',
                'email' => 'maria.garcia@servitaxi.com',
                'rol' => 'operator',
                'password' => Hash::make('Operador4*'),
            ],
            [
                'name' => 'Luis Rodríguez',
                'email' => 'luis.rodriguez@servitaxi.com',
                'rol' => 'operator',
                'password' => Hash::make('Operador5*'),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('taxistas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('license')->nullable();
            $table->string('state')->nullable();
            $table->string('direction')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert registros en la tabla taxistas
        DB::table('taxistas')->insert([
            [
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@servitaxi.com',
                'phone' => '78541236',
                'license' => '0702031101958',
                'state' => 'Disponible',
                'direction' => 'Calle Los Pinos, San Salvador',
                'password' => Hash::make('ServiTaxi1*'),
            ],
            [
                'name' => 'Ana Ramírez',
                'email' => 'ana.ramirez@servitaxi.com',
                'phone' => '71659847',
                'license' => '0507220801963',
                'state' => 'Disponible',
                'direction' => 'Residencial La Floresta, Santa Tecla',
                'password' => Hash::make('ServiTaxi2*'),
            ],
            [
                'name' => 'José Martínez',
                'email' => 'jose.martinez@servitaxi.com',
                'phone' => '75236984',
                'license' => '0911231501964',
                'state' => 'Disponible',
                'direction' => 'Colonia San Benito, San Salvador',
                'password' => Hash::make('ServiTaxi3*'),
            ],
            [
                'name' => 'María García',
                'email' => 'maria.garcia@servitaxi.com',
                'phone' => '62987413',
                'license' => '0412222201965',
                'state' => 'Disponible',
                'direction' => 'Colonia Escalón, San Salvador',
                'password' => Hash::make('ServiTaxi4*'),
            ],
            [
                'name' => 'Luis Rodríguez',
                'email' => 'luis.rodriguez@servitaxi.com',
                'phone' => '78541296',
                'license' => '0811251901966',
                'state' => 'Disponible',
                'direction' => 'Calle El Roble, Soyapango',
                'password' => Hash::make('ServiTaxi5*'),
            ],
            [
                'name' => 'Sofia García',
                'email' => 'sofia.garcia@servitaxi.com',
                'phone' => '74125896',
                'license' => '0612242201967',
                'state' => 'Disponible',
                'direction' => 'Barrio Santa Anita, Santa Ana',
                'password' => Hash::make('ServiTaxi6*'),
            ],
            [
                'name' => 'Laura Herrera',
                'email' => 'laura.herrera@servitaxi.com',
                'phone' => '78563214',
                'license' => '0711021101968',
                'state' => 'Disponible',
                'direction' => 'Colonia Zacamil, Mejicanos',
                'password' => Hash::make('ServiTaxi7*'),
            ],
            [
                'name' => 'Juan González',
                'email' => 'juan.gonzalez@servitaxi.com',
                'phone' => '75216398',
                'license' => '1011021001969',
                'state' => 'Disponible',
                'direction' => 'Calle Los Laureles, San Salvador',
                'password' => Hash::make('ServiTaxi8*'),
            ],
            [
                'name' => 'Andrea Ramos',
                'email' => 'andrea.ramos@servitaxi.com',
                'phone' => '71459863',
                'license' => '1111141201970',
                'state' => 'Disponible',
                'direction' => 'Colonia Merliot, Santa Tecla',
                'password' => Hash::make('ServiTaxi9*'),
            ],
            [
                'name' => 'Roberto Castro',
                'email' => 'roberto.castro@servitaxi.com',
                'phone' => '75896321',
                'license' => '1211031201971',
                'state' => 'Disponible',
                'direction' => 'Avenida Las Magnolias, San Salvador',
                'password' => Hash::make('ServiTaxi10*'),
            ],
            
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('taxistas');
    }
};

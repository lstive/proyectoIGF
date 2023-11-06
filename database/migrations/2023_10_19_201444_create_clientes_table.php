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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('direction')->nullable();
        });

        DB::table('clientes')->insert([
            [
                'name' => 'Ana Rodríguez',
                'phone' => '78541236',
                'direction' => 'Calle Los Pinos, San Salvador',
            ],
            [
                'name' => 'José Pérez',
                'phone' => '71659847',
                'direction' => 'Residencial La Floresta, Santa Tecla',
            ],
            [
                'name' => 'Maria López',
                'phone' => '75236984',
                'direction' => 'Colonia San Benito, San Salvador',
            ],
            [
                'name' => 'Carlos Martinez',
                'phone' => '62987413',
                'direction' => 'Colonia Escalón, San Salvador',
            ],
            [
                'name' => 'Sofia García',
                'phone' => '78541296',
                'direction' => 'Calle El Roble, Soyapango',
            ],
            [
                'name' => 'Luis Sánchez',
                'phone' => '74125896',
                'direction' => 'Barrio Santa Anita, Santa Ana',
            ],
            [
                'name' => 'Laura Herrera',
                'phone' => '78563214',
                'direction' => 'Colonia Zacamil, Mejicanos',
            ],
            [
                'name' => 'Juan González',
                'phone' => '75216398',
                'direction' => 'Calle Los Laureles, San Salvador',
            ],
            [
                'name' => 'Andrea Ramos',
                'phone' => '71459863',
                'direction' => 'Colonia Merliot, Santa Tecla',
            ],
            [
                'name' => 'Roberto Castro',
                'phone' => '75896321',
                'direction' => 'Avenida Las Magnolias, San Salvador',
            ],
            [
                'name' => 'Isabella Mendez',
                'phone' => '71625874',
                'direction' => 'Calle San Antonio, Ilopango',
            ],
            [
                'name' => 'Miguel Ruiz',
                'phone' => '78563201',
                'direction' => 'Colonia El Progreso, Soyapango',
            ],
            [
                'name' => 'Patricia Vásquez',
                'phone' => '75236901',
                'direction' => 'Colonia Escalón, San Salvador',
            ],
            [
                'name' => 'Fernando Aguilar',
                'phone' => '78521463',
                'direction' => 'Residencial Las Brisas, Antiguo Cuscatlán',
            ],
            [
                'name' => 'Ana Maria Fuentes',
                'phone' => '74152698',
                'direction' => 'Calle 5 de Noviembre, San Miguel',
            ],
            [
                'name' => 'Eduardo García',
                'phone' => '78541263',
                'direction' => 'Barrio La Vega, San Salvador',
            ],
            [
                'name' => 'Sofia Ramirez',
                'phone' => '78562314',
                'direction' => 'Colonia San Benito, San Salvador',
            ],
            [
                'name' => 'Manuel Henriquez',
                'phone' => '78965421',
                'direction' => 'Avenida Monsenor Romero, Mejicanos',
            ],
            [
                'name' => 'Carmen Pineda',
                'phone' => '71234587',
                'direction' => 'Calle El Almendro, Ahuachapán',
            ],
            [
                'name' => 'Guillermo Torres',
                'phone' => '78521475',
                'direction' => 'Residencial Las Rosas, Santa Ana',
            ],

        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

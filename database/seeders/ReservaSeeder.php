<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reserva;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reserva::create([
            'user_id' => 3,
            'sala_id' => 1,
            'fecha' => '2024-11-10',
            'hora' => '08:00:00',
            'estado' => 'R', // Rechazada
        ]);

        Reserva::create([
            'user_id' => 2,
            'sala_id' => 2,
            'fecha' => Carbon::tomorrow()->toDateString(),
            'hora' => '09:00:00',
            'estado' => 'P', // Pendiente
        ]);

        Reserva::create([
            'user_id' => 2,
            'sala_id' => 1,
            'fecha' => Carbon::tomorrow()->toDateString(),
            'hora' => '10:00:00',
            'estado' => 'A', // Aceptada
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sala;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sala::create([
            'nombre' => 'Sala A',
            'descripcion' => 'Sala de coworking con capacidad para 4 personas',
        ]);

        Sala::create([
            'nombre' => 'Sala B',
            'descripcion' => 'Sala de coworking para reuniones pequeñas',
        ]);

        Sala::create([
            'nombre' => 'Sala C',
            'descripcion' => 'Sala grande para eventos y conferencias',
        ]);
    }
}

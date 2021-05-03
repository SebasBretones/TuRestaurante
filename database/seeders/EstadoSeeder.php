<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create(['nombre'=>'Espera']);
        Estado::create(['nombre'=>'Preparación']);
        Estado::create(['nombre'=>'Finalizado']);
        Estado::create(['nombre'=>'Entregado']);
    }
}

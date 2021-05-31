<?php

namespace Database\Seeders;

use App\Models\Bebida;
use App\Models\Factura;
use App\Models\Mesa;
use App\Models\Tipotapa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadoSeeder::class);
        $this->call(TipotapaSeeder::class);
        $this->call(TipobebidaSeeder::class);
    }
}

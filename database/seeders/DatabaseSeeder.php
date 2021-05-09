<?php

namespace Database\Seeders;

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
        $this->call(DistribucionSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(TipotapaSeeder::class);
        $this->call(TapaSeeder::class);
        $this->call(TipobebidaSeeder::class);
        $this->call(BebidaSeeder::class);
        Factura::factory(30)->create();
        $this->call(MesaSeeder::class);
    }
}

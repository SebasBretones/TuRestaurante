<?php

namespace Database\Seeders;

use App\Models\Mesa;
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
        $this->call(TapaSeeder::class);
        Mesa::factory(30)->create();
    }
}

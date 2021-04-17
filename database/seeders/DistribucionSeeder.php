<?php

namespace Database\Seeders;

use App\Models\Distribucion;
use Illuminate\Database\Seeder;

class DistribucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Distribucion::create(['nombre'=>'Terraza']);
        Distribucion::create(['nombre'=>'Barra']);
        Distribucion::create(['nombre'=>'Interior']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Tipotapa;
use Illuminate\Database\Seeder;

class TipotapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipotapa::create(['nombre'=>'Tapa']);
        Tipotapa::create(['nombre'=>'Ración']);
    }
}

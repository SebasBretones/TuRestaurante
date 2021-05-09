<?php

namespace Database\Seeders;

use App\Models\Tipobebida;
use Illuminate\Database\Seeder;

class TipobebidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipobebida::create(['nombre'=>'Con tapa']);
        Tipobebida::create(['nombre'=>'Sin tapa']);
    }
}

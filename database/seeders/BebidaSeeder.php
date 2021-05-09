<?php

namespace Database\Seeders;

use App\Models\Bebida;
use Illuminate\Database\Seeder;

class BebidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bebida::create(['nombre'=>'Fanta','tipobebida_id'=>'2']);
        Bebida::create(['nombre'=>'Coca Cola','tipobebida_id'=>'2']);
        Bebida::create(['nombre'=>'Mosto','tipobebida_id'=>'1']);
        Bebida::create(['nombre'=>'Vino','tipobebida_id'=>'1']);
        Bebida::create(['nombre'=>'Cerveza','tipobebida_id'=>'1']);
        Bebida::create(['nombre'=>'Champagne','tipobebida_id'=>'1']);
        Bebida::create(['nombre'=>'Tinto','tipobebida_id'=>'1']);
    }
}

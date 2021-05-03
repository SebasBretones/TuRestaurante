<?php

namespace Database\Seeders;

use App\Models\Tapa;
use Illuminate\Database\Seeder;

class TapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tapa::create(['nombre'=>'Carne con tomate','tipo'=>'Tapa']);
        Tapa::create(['nombre'=>'Patatas bravas','tipo'=>'Tapa']);
        Tapa::create(['nombre'=>'Cabra burguer','tipo'=>'Tapa']);
        Tapa::create(['nombre'=>'Carne al ajillo','tipo'=>'Tapa']);
        Tapa::create(['nombre'=>'Solomillo al ajo','tipo'=>'Ración','precio'=>13.40]);
        Tapa::create(['nombre'=>'Aguja','tipo'=>'Tapa']);
        Tapa::create(['nombre'=>'Atún','tipo'=>'Tapa']);
    }
}

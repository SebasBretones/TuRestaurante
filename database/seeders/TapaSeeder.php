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
        Tapa::create(['nombre'=>'Carne con tomate','tipotapa_id'=>'1']);
        Tapa::create(['nombre'=>'Patatas bravas','tipotapa_id'=>'1']);
        Tapa::create(['nombre'=>'Cabra burguer','tipotapa_id'=>'1']);
        Tapa::create(['nombre'=>'Carne al ajillo','tipotapa_id'=>'1']);
        Tapa::create(['nombre'=>'Solomillo al ajo','tipotapa_id'=>'2','precio'=>13.40]);
        Tapa::create(['nombre'=>'Aguja','tipotapa_id'=>'1']);
        Tapa::create(['nombre'=>'Atún','tipotapa_id'=>'1']);
    }
}

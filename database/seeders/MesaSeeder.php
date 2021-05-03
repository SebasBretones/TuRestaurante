<?php

namespace Database\Seeders;

use App\Models\Distribucion;
use App\Models\Mesa;
use Illuminate\Database\Seeder;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distribucion_ids=Distribucion::pluck('id')->toArray();
        for ($z=0; $z<count($distribucion_ids); $z++){
            for($i=0;$i<5;$i++){
                Mesa::create(['num_asientos'=>random_int(1,10),
                    'distribucion_id'=>$z
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Distribucion;
use App\Models\Factura;
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
        $cont=0;
        $distribucion_ids=Distribucion::pluck('id')->toArray();
        $facturas_ids=Factura::pluck('id')->toArray();
        for ($z=1; $z<=count($distribucion_ids); $z++){
            for($i=1;$i<=10;$i++){
                $cont=$cont+1;
                Mesa::create(['num_asientos'=>random_int(1,10),
                    'distribucion_id'=>$z,
                    'factura_id'=>$cont
                ]);
            }
        }
    }
}

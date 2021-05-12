<?php

namespace Database\Seeders;

use App\Models\Factura;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<30;$i++){
        Factura::create(['total_factura'=>0.0]);
        }
    }
}

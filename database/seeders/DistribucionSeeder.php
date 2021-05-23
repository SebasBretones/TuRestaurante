<?php

namespace Database\Seeders;

use App\Models\Distribucion;
use App\Models\User;
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
        $user_ids=User::pluck('id')->toArray();
        Distribucion::create(['nombre'=>'Terraza','user_id'=>$user_ids[0]]);
        Distribucion::create(['nombre'=>'Barra','user_id'=>$user_ids[0]]);
        Distribucion::create(['nombre'=>'Interior','user_id'=>$user_ids[0]]);
    }
}

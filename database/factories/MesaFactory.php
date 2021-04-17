<?php

namespace Database\Factories;

use App\Models\Distribucion;
use App\Models\Mesa;
use Illuminate\Database\Eloquent\Factories\Factory;

class MesaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mesa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $distribucion_ids=Distribucion::pluck('id')->toArray();
        return [
            'num_asientos'=>$this->faker->numberBetween($min=2, $max=10),
            'distribucion_id'=>$this->faker->randomElement($distribucion_ids)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Bebida;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BebidaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bebida::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->firstNameMale,
            'precio'=>$this->faker->numberBetween($min=1, $max=10),
            'tipobebida_id'=>$this->faker->randomElement([1,2]),
            'user_id'=>1

        ];
    }
}

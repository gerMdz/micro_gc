<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Autor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'genero' => $genero = $this->faker->randomElement(['male', 'female']),
            'nombre' => $this->faker->name($genero),
            'pais' => $this->faker->country
        ];
    }
}

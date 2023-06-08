<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Libro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(3, true),
            'descripcion' => $this->faker->sentence(6, true),
            'precio' => $this->faker->numberBetween(5, 25) * 1000,
            'autor_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}

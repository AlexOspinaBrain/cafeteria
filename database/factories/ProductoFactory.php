<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categoria_id' => Categoria::inRandomOrder()->value('id'),
            'nombre' => $this->faker->words(3, true),
            'referencia' => $this->faker->words(1, true),
            'precio' => $this->faker->randomNumber(5, true),
            'peso' => $this->faker->randomNumber(2, true),
            'stock' => $this->faker->randomElement([0,2,5,10]),

        ];
    }
}

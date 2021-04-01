<?php

namespace Database\Factories;

use App\Models\Cartographer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartographerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cartographer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $birth = $this->faker->numberBetween(0, 1000);
        $death = $birth + $this->faker->numberBetween(30, 100);

        return [
            'name' => $this->faker->name,
            'place' => $this->faker->country,
            'lifespan' => "{$birth}-{$death}",
        ];
    }
}

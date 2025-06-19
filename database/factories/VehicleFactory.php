<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'plate' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{4}'),
            'model' => $this->faker->word(),
            'type_id' => Type::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'color' => $this->faker->colorName(),
            'year' => $this->faker->year(),
            'engine_number' => $this->faker->unique()->regexify('[A-Z0-9]{17}'),
            'chassis_number' => $this->faker->unique()->regexify('[A-Z0-9]{17}'),
            'transmission' => $this->faker->randomElement(['Automatica', 'Manual']),
            'seats' => $this->faker->numberBetween(2, 8),
            'fuel' => $this->faker->randomElement(['Gasolina', 'Diesel', 'Gas']),
            'description' => $this->faker->text(120),
            'status' => 1,
        ];
    }
}

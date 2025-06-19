<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /* 'user_id' => User::factory(),
            'vehicle_id' => Vehicle::all()->random()->id,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'price_per_day' => $this->faker->randomFloat(2, 20, 200),
            'total_price' => $this->faker->randomFloat(2, 100, 2000),
            'status' => $this->faker->randomElement(['Pendiente', 'Confirmado', 'Completado', 'Cancelado']),
            'payment_method' => $this->faker->randomElement(['Yape', 'Plin', 'Efectivo']),
            'transaction_id' => $this->faker->uuid,
            'pickup_location' => $this->faker->address,
            'manual_price' => $this->faker->boolean, */
        ];
    }
}
